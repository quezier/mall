<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class GoodsOrderModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'goodsord_businessid'=>'商家id',
		'goodsord_type'=>'订单类型',
		'goodsord_sn'=>'唯一订单号',
		'user_id'=>'用户id',
		'goodsord_goods_num'=>'订单包括的商品总数量',
		'goodsord_goods_info'=>'商品基本信息',
		'goodsord_status'=>'订单状态',
		'is_agree_try'=>'是否同意试用',
		'goodsord_shipping_status'=>'发货状态',
		'goodsord_pay_staus'=>'付款状态',
		'goodsord_consignee'=>'收货人姓名',
		'goodsord_country'=>'收货人国家id',
		'goodsord_province'=>'收货人省份id',
		'goodsord_city'=>'收货人城市id',
		'goodsord_district'=>'收货人地区id',
		'goodsord_address'=>'收货人详细地址',
		'goodsord_zipcode'=>'收货人邮编',
		'goodsord_tel'=>'收货人固定电话',
		'goodsord_mobile'=>'收货人手机',
		'goodsord_email'=>'收货人email',
		'goodsord_best_date'=>'最佳收货时间',
		'goodsord_sign_bulding'=>'送货标志性建筑',
		'goodsord_postscript'=>'订单附言',
		'shipping_id'=>'配送方式id',
		'goodsord_shipping_name'=>'配送方式名称',
		'pay_id'=>'支付方式id',
		'goodsord_pay_name'=>'支付方式名称',
		'goodsord_invoice_title'=>'发票抬头',
		'goodsord_invoice_content'=>'发票内容',
		'goodsord_invoice_amount'=>'发票金额',
		'goodsord_shipping_amount'=>'配送费用',
		'goodsord_insurance_amount'=>'保价费用',
		'goodsord_paid_amount'=>'已付款金额',
		'goodsord_amount'=>'应付款金额',
		'goodsord_add_date'=>'生成时间',
		'goodsord_confirm_date'=>'确认时间',
		'goodsord_pay_date'=>'支付时间',
		'goodsord_shipping_date'=>'配送时间',
		'goodsord_need_invoice'=>'是否需要发票',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'goods_order';
        $this->_validateRuleArray = array(
			'goodsord_businessid'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'商家id的值必须是整数且必须是正数,最大长度11'),
			'goodsord_type'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'订单类型的值必须是整数且,最大长度1'),
			'goodsord_sn'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'唯一订单号的值必须是字符且,最大长度80'),
			'user_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'用户id的值必须是整数且必须是正数,最大长度11'),
			'goodsord_goods_num'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'订单包括的商品总数量的值必须是整数且,最大长度11'),
			'goodsord_goods_info'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品基本信息的值必须是字符且,最大长度2000'),
			'goodsord_status'=>array('rule'=>'/^-{0,1}[0-9]{1,2}$/','tip'=>'订单状态的值必须是整数且,最大长度2'),
			'is_agree_try'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否同意试用的值必须是整数且,最大长度1'),
			'goodsord_shipping_status'=>array('rule'=>'/^-{0,1}[0-9]{1,2}$/','tip'=>'发货状态的值必须是整数且,最大长度2'),
			'goodsord_pay_staus'=>array('rule'=>'/^-{0,1}[0-9]{1,2}$/','tip'=>'付款状态的值必须是整数且,最大长度2'),
			'goodsord_consignee'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'收货人姓名的值必须是字符且,最大长度60'),
			'goodsord_country'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'收货人国家id的值必须是整数且必须是正数,最大长度11'),
			'goodsord_province'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'收货人省份id的值必须是整数且必须是正数,最大长度11'),
			'goodsord_city'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'收货人城市id的值必须是整数且必须是正数,最大长度11'),
			'goodsord_district'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'收货人地区id的值必须是整数且必须是正数,最大长度11'),
			'goodsord_address'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'收货人详细地址的值必须是字符且,最大长度200'),
			'goodsord_zipcode'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'收货人邮编的值必须是字符且,最大长度100'),
			'goodsord_tel'=>array('rule'=>'/^0\d{2,3}(\-)?\d{7,8}$/','tip'=>'收货人固定电话的值必须是固定电话'),
			'goodsord_mobile'=>array('rule'=>'/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/','tip'=>'收货人手机的值必须是手机'),
			'goodsord_email'=>array('rule'=>'/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i','tip'=>'收货人email的值必须是邮箱'),
			'goodsord_best_date'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'最佳收货时间的值必须是整数且,最大长度11'),
			'goodsord_sign_bulding'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'送货标志性建筑的值必须是字符且,最大长度200'),
			'goodsord_postscript'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'订单附言的值必须是字符且,最大长度200'),
			'shipping_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'配送方式id的值必须是整数且必须是正数,最大长度11'),
			'goodsord_shipping_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'配送方式名称的值必须是字符且,最大长度100'),
			'pay_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'支付方式id的值必须是整数且必须是正数,最大长度11'),
			'goodsord_pay_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'支付方式名称的值必须是字符且,最大长度100'),
			'goodsord_invoice_title'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'发票抬头的值必须是字符且,最大长度200'),
			'goodsord_invoice_content'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'发票内容的值必须是字符且,最大长度200'),
			'goodsord_invoice_amount'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'发票金额的值必须是小数且,最大长度11'),
			'goodsord_shipping_amount'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'配送费用的值必须是小数且,最大长度11'),
			'goodsord_insurance_amount'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'保价费用的值必须是小数且,最大长度11'),
			'goodsord_paid_amount'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'已付款金额的值必须是小数且,最大长度11'),
			'goodsord_amount'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'应付款金额的值必须是小数且,最大长度11'),
			'goodsord_add_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'生成时间的值必须是整数且必须是正数,最大长度11'),
			'goodsord_confirm_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'确认时间的值必须是整数且必须是正数,最大长度11'),
			'goodsord_pay_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'支付时间的值必须是整数且必须是正数,最大长度11'),
			'goodsord_shipping_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'配送时间的值必须是整数且必须是正数,最大长度11'),
			'goodsord_need_invoice'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否需要发票的值必须是整数且,最大长度1'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'goodsord_businessid'=>0,
			'goodsord_type'=>0,
			'goodsord_sn'=>'无',
			'user_id'=>0,
			'goodsord_goods_num'=>0,
			'goodsord_goods_info'=>'无',
			'goodsord_status'=>0,
			'is_agree_try'=>0,
			'goodsord_shipping_status'=>0,
			'goodsord_pay_staus'=>0,
			'goodsord_consignee'=>'无',
			'goodsord_country'=>0,
			'goodsord_province'=>0,
			'goodsord_city'=>0,
			'goodsord_district'=>0,
			'goodsord_address'=>'无',
			'goodsord_zipcode'=>'无',
			'goodsord_tel'=>'0731-88888888',
			'goodsord_mobile'=>'13888888888',
			'goodsord_email'=>'test@test.com',
			'goodsord_best_date'=>0,
			'goodsord_sign_bulding'=>'无',
			'goodsord_postscript'=>'无',
			'shipping_id'=>0,
			'goodsord_shipping_name'=>'无',
			'pay_id'=>0,
			'goodsord_pay_name'=>'无',
			'goodsord_invoice_title'=>'无',
			'goodsord_invoice_content'=>'无',
			'goodsord_invoice_amount'=>0.0,
			'goodsord_shipping_amount'=>0.0,
			'goodsord_insurance_amount'=>0.0,
			'goodsord_paid_amount'=>0.0,
			'goodsord_amount'=>0.0,
			'goodsord_add_date'=>0,
			'goodsord_confirm_date'=>0,
			'goodsord_pay_date'=>0,
			'goodsord_shipping_date'=>0,
			'goodsord_need_invoice'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO goods_order (id,goodsord_businessid,goodsord_type,goodsord_sn,user_id,goodsord_goods_num,goodsord_goods_info,goodsord_status,is_agree_try,goodsord_shipping_status,goodsord_pay_staus,goodsord_consignee,goodsord_country,goodsord_province,goodsord_city,goodsord_district,goodsord_address,goodsord_zipcode,goodsord_tel,goodsord_mobile,goodsord_email,goodsord_best_date,goodsord_sign_bulding,goodsord_postscript,shipping_id,goodsord_shipping_name,pay_id,goodsord_pay_name,goodsord_invoice_title,goodsord_invoice_content,goodsord_invoice_amount,goodsord_shipping_amount,goodsord_insurance_amount,goodsord_paid_amount,goodsord_amount,goodsord_add_date,goodsord_confirm_date,goodsord_pay_date,goodsord_shipping_date,goodsord_need_invoice,is_del) VALUES (NULL,:goodsord_businessid,:goodsord_type,:goodsord_sn,:user_id,:goodsord_goods_num,:goodsord_goods_info,:goodsord_status,:is_agree_try,:goodsord_shipping_status,:goodsord_pay_staus,:goodsord_consignee,:goodsord_country,:goodsord_province,:goodsord_city,:goodsord_district,:goodsord_address,:goodsord_zipcode,:goodsord_tel,:goodsord_mobile,:goodsord_email,:goodsord_best_date,:goodsord_sign_bulding,:goodsord_postscript,:shipping_id,:goodsord_shipping_name,:pay_id,:goodsord_pay_name,:goodsord_invoice_title,:goodsord_invoice_content,:goodsord_invoice_amount,:goodsord_shipping_amount,:goodsord_insurance_amount,:goodsord_paid_amount,:goodsord_amount,:goodsord_add_date,:goodsord_confirm_date,:goodsord_pay_date,:goodsord_shipping_date,:goodsord_need_invoice,:is_del)";
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