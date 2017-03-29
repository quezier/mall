<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class BrandModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'brand_name'=>'品牌名称',
		'brand_pinyin'=>'拼音名称',
		'brand_en'=>'英文名',
		'brand_logo'=>'品牌logo',
		'brand_desc'=>'品牌描述',
		'brand_url'=>'品牌网址',
		'brand_sort_order'=>'排序',
		'brand_is_show'=>'是否显示',
		'brand_add_date'=>'品牌添加时间',
		'brand_admin_id'=>'发布人(管理员)',
		'brand_business_id'=>'发布人(商家)',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'brand';
        $this->_validateRuleArray = array(
			'brand_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'品牌名称的值必须是字符且,最大长度60'),
			'brand_pinyin'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'拼音名称的值必须是字符且,最大长度200'),
			'brand_en'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'英文名的值必须是字符且,最大长度200'),
			'brand_logo'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'品牌logo的值必须是字符且,最大长度200'),
			'brand_desc'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'品牌描述的值必须是字符且,最大长度0'),
			'brand_url'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'品牌网址的值必须是字符且,最大长度200'),
			'brand_sort_order'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'排序的值必须是整数且,最大长度11'),
			'brand_is_show'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否显示的值必须是整数且,最大长度1'),
			'brand_add_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'品牌添加时间的值必须是整数且必须是正数,最大长度11'),
			'brand_admin_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(管理员)的值必须是整数且必须是正数,最大长度11'),
			'brand_business_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(商家)的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'brand_name'=>'无',
			'brand_pinyin'=>'无',
			'brand_en'=>'无',
			'brand_logo'=>'无',
			'brand_desc'=>'无',
			'brand_url'=>'无',
			'brand_sort_order'=>0,
			'brand_is_show'=>0,
			'brand_add_date'=>0,
			'brand_admin_id'=>0,
			'brand_business_id'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO brand (id,brand_name,brand_pinyin,brand_en,brand_logo,brand_desc,brand_url,brand_sort_order,brand_is_show,brand_add_date,brand_admin_id,brand_business_id,is_del) VALUES (NULL,:brand_name,:brand_pinyin,:brand_en,:brand_logo,:brand_desc,:brand_url,:brand_sort_order,:brand_is_show,:brand_add_date,:brand_admin_id,:brand_business_id,:is_del)";
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