<?php
namespace App\Logic;
use App\Model\BrandSeriesModel;
use Core\PubFunc;
class BrandSeriesLogic
{
    private $brandSeriesModel;
    function __construct()
    {
        $this->brandSeriesModel = new BrandSeriesModel();
    }

    function getAllBrandSeries($fields = '*')
    {
        $rs = $this->brandSeriesModel->selectAll('','WHERE is_del=1',null,$fields);
        unset($this->brandSeriesModel);
        return $rs;
    }
    
    function getAll($sql='',$where='WHERE is_del=1',$param=null,$fields = '*')
    {
        $rs = $this->brandSeriesModel->selectAll($sql,$where,$param,$fields);
        unset($this->brandSeriesModel);
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
        $rs = $this->brandSeriesModel->sql($sql,$param);
        unset($this->brandSeriesModel);
        return $rs;
    }
    
    function getNeedFields( $needFields)
    {
        $fields = $this->brandSeriesModel->fields;
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

    function pageBrandSeriesList( $param)
    {
        $p = 1;
        if (!empty($param['p'])) {
            $p = $param['p'];
        }
        unset($param['p']);
        $where = ' WHERE 1=1 ';
        $changeResult = $this->brandSeriesModel->getWhereAndParamForPage($param,true);
        if($changeResult['status']==2)
        {
            return $changeResult;
        }
        $where.= $changeResult['result']['where'];
        $data = $changeResult['result']['param'];
        $where.=" ORDER BY brandseries.id desc";
        $sql="select brand.brand_name as brand_id,brandseries.id,brandseries.brandser_name,brandseries.brandser_pinyin,brandseries.brandser_en,brandseries.brandser_add_date,".
            "brandseries.is_del from brand_series as brandseries LEFT JOIN brand on brand.id=brandseries.brand_id".$where;
        $rs = $this->brandSeriesModel->page($p, 0, $sql, '',$data , $field = '*');
        return $rs;
    }

    /**
     * 插入记录
     * @param array $data
     * @return array
     */
    function insert( $data)
    {
        $rs = $this->brandSeriesModel->insert($data);
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
        $rs = $this->brandSeriesModel->_testData;
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
        $rs = $this->brandSeriesModel->updateAuto($data);
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
        $rs = $this->brandSeriesModel->selectOne('','WHERE is_del=1 AND id=:id',array('id'=>$id),$fields);
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
        $rs = $this->brandSeriesModel->selectOne($sql,$where,$param,$fields);
        return $rs;
    }

    function getByBrandID($bid)
    {
        $rs = $this->getAll('',"WHERE is_del=1 AND brand_id=:bid",array('bid'=>$bid));
        return $rs;
    }

}