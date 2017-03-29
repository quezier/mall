<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class OrderWithGoodsModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'goods_order_id'=>'订单id',
		'goods_id'=>'商品id',
		'goods_name'=>'商品名称',
		'goods_market_price'=>'市场价',
		'goods_shop_price'=>'零售价',
		'goods_promote_price'=>'促销价',
		'orderwg_num'=>'商品数量',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'order_with_goods';
        $this->_validateRuleArray = array(
			'goods_order_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'订单id的值必须是整数且必须是正数,最大长度11'),
			'goods_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'商品id的值必须是整数且必须是正数,最大长度11'),
			'goods_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品名称的值必须是字符且,最大长度200'),
			'goods_market_price'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'市场价的值必须是小数且,最大长度11'),
			'goods_shop_price'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'零售价的值必须是小数且,最大长度11'),
			'goods_promote_price'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'促销价的值必须是小数且,最大长度11'),
			'orderwg_num'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'商品数量的值必须是整数且,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'goods_order_id'=>0,
			'goods_id'=>0,
			'goods_name'=>'无',
			'goods_market_price'=>0.0,
			'goods_shop_price'=>0.0,
			'goods_promote_price'=>0.0,
			'orderwg_num'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO order_with_goods (id,goods_order_id,goods_id,goods_name,goods_market_price,goods_shop_price,goods_promote_price,orderwg_num,is_del) VALUES (NULL,:goods_order_id,:goods_id,:goods_name,:goods_market_price,:goods_shop_price,:goods_promote_price,:orderwg_num,:is_del)";
        //验证插入的数据是否符合数据库定义的字段规则
        $chkDataArray = $this->validateDbField($this->_testData,$this->_validateRuleArray);
        if($chkDataArray['status']==1)
        {
            $insertResultArray = $this->pdoHelper->setSql($sql)->setParam($chkDataArray['result'])->insert();
            return $insertResultArray;
        }
        return $chkDataArray;
	}
}