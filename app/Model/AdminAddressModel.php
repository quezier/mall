<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class AdminAddressModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'user_id'=>'用户id',
		'useraddr_name'=>'收件人姓名',
		'useraddr_email'=>'收件人邮箱',
		'nation_id'=>'国家',
		'province_id'=>'省份',
		'city_id'=>'城市',
		'country_id'=>'区县',
		'useraddr_address'=>'详细地址',
		'useraddr_zipcode'=>'邮编',
		'useraddr_tel'=>'固定电话',
		'useraddr_mobile'=>'手机',
		'useraddr_sign_building'=>'标志性建筑',
		'useraddr_best_date'=>'最佳收货时间',
		'is_default'=>'是否默认地址',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'admin_address';
        $this->_validateRuleArray = array(
			'user_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'用户id的值必须是整数且必须是正数,最大长度11'),
			'useraddr_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'收件人姓名的值必须是字符且,最大长度60'),
			'useraddr_email'=>array('rule'=>'/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i','tip'=>'收件人邮箱的值必须是邮箱'),
			'nation_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'国家的值必须是整数且必须是正数,最大长度11'),
			'province_id'=>array('rule'=>'/^-{0,0}[0-9]{1,20}$/','tip'=>'省份的值必须是整数且必须是正数,最大长度20'),
			'city_id'=>array('rule'=>'/^-{0,0}[0-9]{1,20}$/','tip'=>'城市的值必须是整数且必须是正数,最大长度20'),
			'country_id'=>array('rule'=>'/^-{0,0}[0-9]{1,20}$/','tip'=>'区县的值必须是整数且必须是正数,最大长度20'),
			'useraddr_address'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'详细地址的值必须是字符且,最大长度100'),
			'useraddr_zipcode'=>array('rule'=>'/^\d{6}$/','tip'=>'邮编的值必须是邮编'),
			'useraddr_tel'=>array('rule'=>'/^0\d{2,3}(\-)?\d{7,8}$/','tip'=>'固定电话的值必须是固定电话'),
			'useraddr_mobile'=>array('rule'=>'/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/','tip'=>'手机的值必须是手机'),
			'useraddr_sign_building'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'标志性建筑的值必须是字符且,最大长度50'),
			'useraddr_best_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'最佳收货时间的值必须是整数且必须是正数,最大长度11'),
			'is_default'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否默认地址的值必须是整数且,最大长度1'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'user_id'=>0,
			'useraddr_name'=>'无',
			'useraddr_email'=>'test@test.com',
			'nation_id'=>0,
			'province_id'=>0,
			'city_id'=>0,
			'country_id'=>0,
			'useraddr_address'=>'无',
			'useraddr_zipcode'=>'123456',
			'useraddr_tel'=>'0731-88888888',
			'useraddr_mobile'=>'13888888888',
			'useraddr_sign_building'=>'无',
			'useraddr_best_date'=>0,
			'is_default'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO admin_address (id,user_id,useraddr_name,useraddr_email,nation_id,province_id,city_id,country_id,useraddr_address,useraddr_zipcode,useraddr_tel,useraddr_mobile,useraddr_sign_building,useraddr_best_date,is_default,is_del) VALUES (NULL,:user_id,:useraddr_name,:useraddr_email,:nation_id,:province_id,:city_id,:country_id,:useraddr_address,:useraddr_zipcode,:useraddr_tel,:useraddr_mobile,:useraddr_sign_building,:useraddr_best_date,:is_default,:is_del)";
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