<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class GoodsCategoryModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'goodscate_name'=>'分类名称',
		'goodscate_pinyin'=>'拼音名称',
		'goodscate_en'=>'英文名称',
		'goodscate_key'=>'分类关键词',
		'goodscate_parent_id'=>'父级id',
		'goodscate_sort_order'=>'排序',
		'goodscate_measure_uint'=>'分类计量单位',
		'goodscate_is_nav'=>'是否显示在导航',
		'goodscate_is_show'=>'是否显示在前台',
		'goodscate_price_grade'=>'价格分级',
		'goodscate_admin_id'=>'发布人(管理员)',
		'goodscate_business_id'=>'发布人(商家)',
		'goodscate_add_date'=>'添加时间',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'goods_category';
        $this->_validateRuleArray = array(
			'goodscate_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'分类名称的值必须是字符且,最大长度100'),
			'goodscate_pinyin'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'拼音名称的值必须是字符且,最大长度200'),
			'goodscate_en'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'英文名称的值必须是字符且,最大长度200'),
			'goodscate_key'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'分类关键词的值必须是字符且,最大长度255'),
			'goodscate_parent_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'父级id的值必须是整数且必须是正数,最大长度11'),
			'goodscate_sort_order'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'排序的值必须是整数且,最大长度11'),
			'goodscate_measure_uint'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'分类计量单位的值必须是字符且,最大长度15'),
			'goodscate_is_nav'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否显示在导航的值必须是整数且,最大长度1'),
			'goodscate_is_show'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否显示在前台的值必须是整数且,最大长度1'),
			'goodscate_price_grade'=>array('rule'=>'/^-{0,1}[0-9]{1,4}$/','tip'=>'价格分级的值必须是整数且,最大长度4'),
			'goodscate_admin_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(管理员)的值必须是整数且必须是正数,最大长度11'),
			'goodscate_business_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(商家)的值必须是整数且必须是正数,最大长度11'),
			'goodscate_add_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'添加时间的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'goodscate_name'=>'无',
			'goodscate_pinyin'=>'无',
			'goodscate_en'=>'无',
			'goodscate_key'=>'无',
			'goodscate_parent_id'=>0,
			'goodscate_sort_order'=>0,
			'goodscate_measure_uint'=>'无',
			'goodscate_is_nav'=>0,
			'goodscate_is_show'=>'0',
			'goodscate_price_grade'=>0,
			'goodscate_admin_id'=>0,
			'goodscate_business_id'=>0,
			'goodscate_add_date'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO goods_category (id,goodscate_name,goodscate_pinyin,goodscate_en,goodscate_key,goodscate_parent_id,goodscate_sort_order,goodscate_measure_uint,goodscate_is_nav,goodscate_is_show,goodscate_price_grade,goodscate_admin_id,goodscate_business_id,goodscate_add_date,is_del) VALUES (NULL,:goodscate_name,:goodscate_pinyin,:goodscate_en,:goodscate_key,:goodscate_parent_id,:goodscate_sort_order,:goodscate_measure_uint,:goodscate_is_nav,:goodscate_is_show,:goodscate_price_grade,:goodscate_admin_id,:goodscate_business_id,:goodscate_add_date,:is_del)";
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