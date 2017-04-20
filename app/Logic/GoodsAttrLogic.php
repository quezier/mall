<?php
namespace App\Logic;
use App\Model\GoodsAttrModel;
use Core\PubFunc;
class GoodsAttrLogic
{
    private $goodsAttrModel;
    function __construct()
    {
        $this->goodsAttrModel = new GoodsAttrModel();
    }

    function getAllGoodsAttr($fields = '*')
    {
        $rs = $this->goodsAttrModel->selectAll('','WHERE is_del=1',null,$fields);
        unset($this->goodsAttrModel);
        return $rs;
    }
    
    function getAll($sql='',$where='WHERE is_del=1',$param=null,$fields = '*')
    {
        $rs = $this->goodsAttrModel->selectAll($sql,$where,$param,$fields);
        unset($this->goodsAttrModel);
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
        $rs = $this->goodsAttrModel->sql($sql,$param);
        unset($this->goodsAttrModel);
        return $rs;
    }
    
    function getNeedFields( $needFields)
    {
        $fields = $this->goodsAttrModel->fields;
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

    function pageGoodsAttrList( $param)
    {
        $p = 1;
        if (!empty($param['p'])) {
            $p = $param['p'];
        }
        unset($param['p']);
        $where = ' WHERE 1=1 and goodsattr.is_del=1 ';
        $changeResult = $this->goodsAttrModel->getWhereAndParamForPage($param,true);
        if($changeResult['status']==2)
        {
            return $changeResult;
        }
        $where.= $changeResult['result']['where'];
        $data = $changeResult['result']['param'];
        $where.=" ORDER BY goodsattr.id desc";
        $sql = "select goodsattr.id,goodsattr.goodsattr_name,goodsattr.goodsattr_value,goodscategory.goodscate_name as goods_category_id,goodsattr.goodsattr_add_date,admin.name as goodsattr_admin_id,goodsattr.is_del  ".
            " from goods_attr as goodsattr LEFT JOIN admin ON admin.id=goodsattr.goodsattr_admin_id LEFT JOIN goods_category as goodscategory on goodscategory.id=goodsattr.goods_category_id".$where;
        $rs = $this->goodsAttrModel->page($p, 0, $sql, '',$data , $field = '*');
        return $rs;
    }

    /**
     * 插入记录
     * @param array $data
     * @return array
     */
    function insert( $data)
    {
        $rs = $this->goodsAttrModel->insert($data);
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
        $rs = $this->goodsAttrModel->_testData;
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
        $rs = $this->goodsAttrModel->updateAuto($data);
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
        $rs = $this->goodsAttrModel->selectOne('','WHERE is_del=1 AND id=:id',array('id'=>$id),$fields);
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
        $rs = $this->goodsAttrModel->selectOne($sql,$where,$param,$fields);
        return $rs;
    }

    function getByCateID($cid)
    {
        $rs = $this->getAll('',"WHERE is_del=1 AND goods_category_id=:cid",array('cid'=>$cid));
        return $rs;
    }
}