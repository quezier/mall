<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class ShippingTypeModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'shipping_code'=>'配送代码',
		'shipping_name'=>'名称',
		'shipping_desc'=>'描述',
		'shipping_inurance'=>'保价费用',
		'shipping_is_arrivepay'=>'是否可以货到付款',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'shipping_type';
        $this->_validateRuleArray = array(
			'shipping_code'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'配送代码的值必须是字符且,最大长度50'),
			'shipping_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'名称的值必须是字符且,最大长度50'),
			'shipping_desc'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'描述的值必须是字符且,最大长度200'),
			'shipping_inurance'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'保价费用的值必须是小数且,最大长度11'),
			'shipping_is_arrivepay'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可以货到付款的值必须是整数且,最大长度1'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'shipping_code'=>'无',
			'shipping_name'=>'无',
			'shipping_desc'=>'无',
			'shipping_inurance'=>0.0,
			'shipping_is_arrivepay'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO shipping_type (id,shipping_code,shipping_name,shipping_desc,shipping_inurance,shipping_is_arrivepay,is_del) VALUES (NULL,:shipping_code,:shipping_name,:shipping_desc,:shipping_inurance,:shipping_is_arrivepay,:is_del)";
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