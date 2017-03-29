<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class GoodsWithAttrModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'goods_id'=>'商品id',
		'goodsattr_id'=>'商品属性id',
		'goodswa_value'=>'商品的属性值',
		'goodswa_price'=>'属性价格',
		'goodswa_pic'=>'属性图片',
		'goodswa_number'=>'属性库存',
		'goodswa_add_date'=>'添加时间',
		'goodswa_admin_id'=>'发布人(管理员)',
		'goodswa_business_id'=>'发布人(商家)',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'goods_with_attr';
        $this->_validateRuleArray = array(
			'goods_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'商品id的值必须是整数且必须是正数,最大长度11'),
			'goodsattr_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'商品属性id的值必须是整数且必须是正数,最大长度11'),
			'goodswa_value'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品的属性值的值必须是字符且,最大长度100'),
			'goodswa_price'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'属性价格的值必须是小数且,最大长度11'),
			'goodswa_pic'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'属性图片的值必须是字符且,最大长度200'),
			'goodswa_number'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'属性库存的值必须是整数且,最大长度11'),
			'goodswa_add_date'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'添加时间的值必须是整数且,最大长度11'),
			'goodswa_admin_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(管理员)的值必须是整数且必须是正数,最大长度11'),
			'goodswa_business_id'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'发布人(商家)的值必须是整数且,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'goods_id'=>0,
			'goodsattr_id'=>0,
			'goodswa_value'=>'无',
			'goodswa_price'=>0.0,
			'goodswa_pic'=>'无',
			'goodswa_number'=>0,
			'goodswa_add_date'=>0,
			'goodswa_admin_id'=>0,
			'goodswa_business_id'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO goods_with_attr (id,goods_id,goodsattr_id,goodswa_value,goodswa_price,goodswa_pic,goodswa_number,goodswa_add_date,goodswa_admin_id,goodswa_business_id,is_del) VALUES (NULL,:goods_id,:goodsattr_id,:goodswa_value,:goodswa_price,:goodswa_pic,:goodswa_number,:goodswa_add_date,:goodswa_admin_id,:goodswa_business_id,:is_del)";
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