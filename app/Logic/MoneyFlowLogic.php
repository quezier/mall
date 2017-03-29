<?php
namespace App\Logic;
use App\Model\MoneyFlowModel;
use Core\CreateUniqueNo;
use Core\PubFunc;
class MoneyFlowLogic
{
    public $moneyFlowModel;
    function __construct()
    {
        $this->moneyFlowModel = new MoneyFlowModel();
    }
    
    function getSelfPdo()
    {
        return $this->moneyFlowModel->pdo;
    }

    function getAllMoneyFlow($fields = '*')
    {
        $rs = $this->moneyFlowModel->selectAll('','WHERE is_del=1',null,$fields);
        unset($this->moneyFlowModel);
        return $rs;
    }
    
    function getAll($sql='',$where='WHERE is_del=1',$param=null,$fields = '*')
    {
        $rs = $this->moneyFlowModel->selectAll($sql,$where,$param,$fields);
        unset($this->moneyFlowModel);
        return $rs;
    }
    /**
     *直接执行sql,占位符不能用?号，必须用":字母"
     *@param string $sql 原生sql语句
     *@param array $param 参数数组，如: array('id'=>10)
     *@return array array(rowCount) 返回受影响的行数，以数组形式返回
     */
    function sql($sql,$param = null)
    {
        $rs = $this->moneyFlowModel->sql($sql,$param);
        unset($this->moneyFlowModel);
        return $rs;
    }
    
    function getNeedFields( $needFields)
    {
        $fields = $this->moneyFlowModel->fields;
        $tmpArray = array();
        if(!empty($fields)&&!empty($needFields)&&count($needFields)>0)
        {
            foreach ($needFields as $nfKey => $nfVal)
            {
                if(array_key_exists($nfVal,$fields))
                {
                    $tmpArray[$nfVal] = $fields[$nfVal];
                }
            }
            return PubFunc::returnArray(1,$tmpArray,'获取数组成功');
        }
        else{
            return PubFunc::returnArray(2,false,'缺少参数');
        }
    }

    function pageMoneyFlowList( $param)
    {
        $p = 1;
        if (!empty($param['p'])) {
            $p = $param['p'];
        }
        unset($param['p']);
        $where = ' WHERE 1=1 ';
        $changeResult = $this->moneyFlowModel->getWhereAndParamForPage($param,true);
        if($changeResult['status']==2)
        {
            return $changeResult;
        }
        ;
        $where.= $changeResult['result']['where'];
        $data = $changeResult['result']['param'];
        $adminID = PubFunc::session('admin_id');
        $role_id=PubFunc::session('admin_role_id');
        if($role_id==6)//运营商
        {
            $where.=' AND admin.operation_center_id='.$adminID .' OR  moneyflow.admin_id='.$adminID;
        }
        if($role_id==7)//贸易商
        {
            $where.=' AND admin.member_company_id='.$adminID .' OR  moneyflow.admin_id='.$adminID;
        }
        if($role_id==8)//代理商
        {
            $where.=' AND admin.agent_id='.$adminID .' OR  moneyflow.admin_id='.$adminID;
        }
        $sql = "select moneyflow.id,admin.name as admin_id,role.role_name as role_id,moneyflow.trade_no,moneyflow.moneyflow_no,moneyflow.change_money,"
            ." moneyflow.trade_type,moneyflow.trade_date,moneyflow.pretrade_balance,moneyflow.aftertrade_balance"
            ." from money_flow as moneyflow LEFT JOIN admin  ON moneyflow.admin_id=admin.id LEFT JOIN role ON moneyflow.role_id=role.id "
            .$where." ORDER BY moneyflow.id desc";
        $rs = $this->moneyFlowModel->page($p, 0, $sql, '',$data , $field = '*');
        //echo $this->moneyFlowModel->pdoHelper->sqlDebug;exit;
        return $rs;
    }

    /**
     * 插入记录
     * @param array $data
     * @return array
     */
    function insert( $data)
    {
        $rs = $this->moneyFlowModel->insert($data);
        return $rs;
    }

    /**
     * 与测试数据合并生成插入数据，并插入,因为每个字段不能为空
     * @param array $data 要插入的数据
     * @return array
     */
    function insertFromTestData( $data)
    {
        $insertTestData = $this->getInsertData();
        $data = array_merge($insertTestData, $data);
        $rs = $this->insert($data);
        return $rs;
    }

    /**
     * 获取测试插入用的数据
     * @return array
     */
    function getInsertData()
    {
        $rs = $this->moneyFlowModel->_testData;
        $rs['is_del']=1;
        return $rs;
    }

    /**
     * 根据主键id更新数据
     * @param array $data 要更新的数据集
     * @return array
     */
    function update( $data)
    {
        $rs = $this->moneyFlowModel->updateAuto($data);
        return $rs;
    }

    /**
     * 根据id查询数据
     * @param int $id 主键id
     * @param string $fields 指定字段
     * @return array
     */
    function getById( $id,$fields = '*')
    {
        if(empty($id)){return PubFunc::returnArray(2,false,'缺少参数');}
        $rs = $this->moneyFlowModel->selectOne('','WHERE is_del=1 AND id=:id',array('id'=>$id),$fields);
        return $rs;
    }
    
    /**
     * 查询单条数据，占位符不能用?号，必须用":字母"
     * @param string $sql 自定义sql语句
     * @param string $where 条件 需要带WHERE关键字
     * @param array $param 参数 数组，对应占位符的参数
     * @param string $fields 指定字段 默认*
     * @return array
     */
    function getOne($sql='',$where='WHERE is_del=1',$param=null,$fields = '*')
    {
        $rs = $this->moneyFlowModel->selectOne($sql,$where,$param,$fields);
        return $rs;
    }

    /**
     * 获取流水添加参数数组
     * @param int $adminID 用户id
     * @param int $roleID 角色id
     * @param int $tradeType 交易类型 1.充值 2.提现 3.冻结保证金 4.解冻保证金 5.扣除交易手续费 6.扣除持仓延期费 7.扣除充值手续费 8.扣除提现手续费 9.加币 10.减币 11.盈 12.亏 13.佣金 14.提成 15.开户赠金 16.推荐赠金 17.充值赠金
     * @param double $preTradeBalance 变动前余额
     * @param double $changeMoney 变动金额
     * @param double $afterTradeBalance 变动后余额
     * @param string $tradeNo 订单号，默认为'无'
     * @return array
     */
    function getAddData($adminID,$roleID,$tradeType,$preTradeBalance,$changeMoney,$afterTradeBalance,$tradeNo="无")
    {
        $moneyflowNo = CreateUniqueNo::createOrder();
        $data = array(
            'admin_id'=>$adminID,
            'role_id'=>$roleID,
            'trade_no'=>!empty($tradeNo)&&$tradeNo!="无"?$tradeNo:'无',
            'moneyflow_no'=>$moneyflowNo,
            'change_money'=>$changeMoney,
            'trade_type'=>$tradeType,
            'pretrade_balance'=>$preTradeBalance,
            'aftertrade_balance'=>$afterTradeBalance,
            'trade_date'=>time()
        );
        return PubFunc::returnArray(1,$data,'查询余额失败');
    }
}