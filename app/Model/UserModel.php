<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class UserModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'user_score'=>'用户积分',
		'user_name'=>'用户名',
		'user_email'=>'邮箱',
		'user_pwd'=>'密码',
		'user_sex'=>'性别',
		'user_logo'=>'用户logo',
		'user_birthday'=>'出生日期',
		'user_reg_date'=>'注册时间',
		'user_mobile'=>'手机',
		'user_login_date'=>'最后登录时间',
		'user_login_ip'=>'最后登录ip',
		'user_login_error'=>'登录错误次数',
		'user_nick'=>'昵称',
		'user_tel'=>'固定电话',
		'user_address'=>'联系地址',
		'user_qq'=>'qq',
		'user_qq_id'=>'qq登录标识',
		'user_sina_openid'=>'新浪openid',
		'user_wx_unionid'=>'微信登录标识',
		'user_wx_openid'=>'微信openid',
		'user_wx_loginopenid'=>'微信登录openid',
		'user_wx_loginunionid'=>'微信登录unionid',
		'user_wx_qrcode'=>'微信带参数二维码',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'user';
        $this->_validateRuleArray = array(
			'user_score'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'用户积分的值必须是小数且,最大长度11'),
			'user_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'用户名的值必须是字符且,最大长度60'),
			'user_email'=>array('rule'=>'/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i','tip'=>'邮箱的值必须是邮箱'),
			'user_pwd'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'密码的值必须是字符且,最大长度100'),
			'user_sex'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'性别的值必须是整数且,最大长度1'),
			'user_logo'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'用户logo的值必须是字符且,最大长度200'),
			'user_birthday'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'出生日期的值必须是整数且,最大长度11'),
			'user_reg_date'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'注册时间的值必须是整数且,最大长度11'),
			'user_mobile'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'手机的值必须是字符且,最大长度60'),
			'user_login_date'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'最后登录时间的值必须是整数且,最大长度11'),
			'user_login_ip'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'最后登录ip的值必须是字符且,最大长度60'),
			'user_login_error'=>array('rule'=>'/^-{0,0}[0-9]{1,2}$/','tip'=>'登录错误次数的值必须是整数且必须是正数,最大长度2'),
			'user_nick'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'昵称的值必须是字符且,最大长度60'),
			'user_tel'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'固定电话的值必须是字符且,最大长度60'),
			'user_address'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'联系地址的值必须是字符且,最大长度100'),
			'user_qq'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'qq的值必须是字符且,最大长度60'),
			'user_qq_id'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'qq登录标识的值必须是字符且,最大长度100'),
			'user_sina_openid'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'新浪openid的值必须是字符且,最大长度100'),
			'user_wx_unionid'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'微信登录标识的值必须是字符且,最大长度100'),
			'user_wx_openid'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'微信openid的值必须是字符且,最大长度100'),
			'user_wx_loginopenid'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'微信登录openid的值必须是字符且,最大长度100'),
			'user_wx_loginunionid'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'微信登录unionid的值必须是字符且,最大长度100'),
			'user_wx_qrcode'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'微信带参数二维码的值必须是字符且,最大长度200'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'user_score'=>0.0,
			'user_name'=>'无',
			'user_email'=>'test@test.com',
			'user_pwd'=>'无',
			'user_sex'=>0,
			'user_logo'=>'无',
			'user_birthday'=>0,
			'user_reg_date'=>0,
			'user_mobile'=>'无',
			'user_login_date'=>0,
			'user_login_ip'=>'无',
			'user_login_error'=>0,
			'user_nick'=>'无',
			'user_tel'=>'无',
			'user_address'=>'无',
			'user_qq'=>'无',
			'user_qq_id'=>'无',
			'user_sina_openid'=>'无',
			'user_wx_unionid'=>'无',
			'user_wx_openid'=>'无',
			'user_wx_loginopenid'=>'无',
			'user_wx_loginunionid'=>'无',
			'user_wx_qrcode'=>'无',
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO user (id,user_score,user_name,user_email,user_pwd,user_sex,user_logo,user_birthday,user_reg_date,user_mobile,user_login_date,user_login_ip,user_login_error,user_nick,user_tel,user_address,user_qq,user_qq_id,user_sina_openid,user_wx_unionid,user_wx_openid,user_wx_loginopenid,user_wx_loginunionid,user_wx_qrcode,is_del) VALUES (NULL,:user_score,:user_name,:user_email,:user_pwd,:user_sex,:user_logo,:user_birthday,:user_reg_date,:user_mobile,:user_login_date,:user_login_ip,:user_login_error,:user_nick,:user_tel,:user_address,:user_qq,:user_qq_id,:user_sina_openid,:user_wx_unionid,:user_wx_openid,:user_wx_loginopenid,:user_wx_loginunionid,:user_wx_qrcode,:is_del)";
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