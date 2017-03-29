<?php
namespace App\Logic;
use App\Model\GoodsModel;
use Core\PubFunc;
class GoodsLogic
{
    private $goodsModel;
    function __construct()
    {
        $this->goodsModel = new GoodsModel();
    }

    function getAllGoods($fields = '*')
    {
        $rs = $this->goodsModel->selectAll('','WHERE is_del=1',null,$fields);
        return $rs;
    }
    
    function getAll($sql='',$where='WHERE is_del=1',$param=null,$fields = '*')
    {
        $rs = $this->goodsModel->selectAll($sql,$where,$param,$fields);
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
        $rs = $this->goodsModel->sql($sql,$param);
        return $rs;
    }
    
    function getNeedFields( $needFields)
    {
        $fields = $this->goodsModel->fields;
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

    function pageGoodsList( $param)
    {
        $p = 1;
        if (!empty($param['p'])) {
            $p = $param['p'];
        }
        unset($param['p']);
        $where = ' WHERE 1=1 ';
        $changeResult = $this->goodsModel->getWhereAndParamForPage($param,true);
        if($changeResult['status']==2)
        {
            return $changeResult;
        }
        $where.= $changeResult['result']['where'];
        $data = $changeResult['result']['param'];
        $where.=" ORDER BY goods.id desc";
        $sql= "select gc.goodscate_name,b.brand_name,bs.brandser_name,goods.goods_name,goods.goods_name_css, "
            ." goods.goods_market_price,goods.goods_shop_price,goods.goods_promote_price,goods.goods_weight,goods.goods_number,goods.goods_warn_number, "
            ." goods.goods_key,goods.goods_brief,goods.goods_is_real,goods.goods_is_gift,goods.goods_is_best,goods.goods_is_new,goods.goods_is_hot,goods.goods_is_promote,"
            ." goods.goods_sort,goods.is_del,goods.id"
            ." from goods LEFT JOIN goods_category as gc ON goods.category_id=gc.id "
            ." LEFT JOIN brand as b ON goods.brand_id=b.id "
            ." LEFT JOIN brand_series as bs ON goods.brand_series_id=bs.id ".$where;
        $rs = $this->goodsModel->page($p, 0, $sql, '',$data , $field = '*');
        return $rs;
    }

    /**
     * 插入记录
     * @param array $data
     * @return array
     */
    function insert( $data)
    {
        $rs = $this->goodsModel->insert($data);
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
        $rs = $this->goodsModel->_testData;
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
        $rs = $this->goodsModel->updateAuto($data);
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
        $rs = $this->goodsModel->selectOne('','WHERE is_del=1 AND id=:id',array('id'=>$id),$fields);
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
        $rs = $this->goodsModel->selectOne($sql,$where,$param,$fields);
        return $rs;
    }
    function getForEdit($gid)
    {
        $rs = $this->sql("select gc.goodscate_name,b.brand_name,bs.brandser_name,g.goods_name,g.goods_name_css, "
            ." g.goods_market_price,g.goods_shop_price,g.goods_promote_price,g.goods_weight,g.goods_number,g.goods_warn_number, "
            ." g.goods_key,g.goods_brief,g.goods_is_real,g.goods_is_gift,g.goods_is_best,g.goods_is_new,g.goods_is_hot,g.goods_is_promote,"
            ." g.goods_sort,g.is_del,g.id"
            ." from goods as g LEFT JOIN goods_category as gc ON g.category_id=gc.id "
            ." LEFT JOIN brand as b ON g.brand_id=b.id "
            ." LEFT JOIN brand_series as bs ON g.brand_series_id=bs.id WHERE g.is_del=1 AND g.id=:id",array('id'=>$gid));
        return $rs;
    }
}