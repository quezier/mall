<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class BrandSeriesModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'brandser_name'=>'品牌系列名称',
		'brandser_pinyin'=>'拼音名称',
		'brandser_en'=>'英文名称',
		'brand_id'=>'品牌id',
		'brandser_detail'=>'详细说明',
		'brandser_mdetail'=>'手机版详情',
		'brandser_add_date'=>'添加时间',
		'brandser_admin_id'=>'发布人(管理员)',
		'brandser_business_id'=>'发布人(商家)',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'brand_series';
        $this->_validateRuleArray = array(
			'brandser_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'品牌系列名称的值必须是字符且,最大长度200'),
			'brandser_pinyin'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'拼音名称的值必须是字符且,最大长度200'),
			'brandser_en'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'英文名称的值必须是字符且,最大长度200'),
			'brand_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'品牌id的值必须是整数且必须是正数,最大长度11'),
			'brandser_detail'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'详细说明的值必须是字符且,最大长度0'),
			'brandser_mdetail'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'手机版详情的值必须是字符且,最大长度0'),
			'brandser_add_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'添加时间的值必须是整数且必须是正数,最大长度11'),
			'brandser_admin_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(管理员)的值必须是整数且必须是正数,最大长度11'),
			'brandser_business_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(商家)的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'brandser_name'=>'无',
			'brandser_pinyin'=>'无',
			'brandser_en'=>'无',
			'brand_id'=>0,
			'brandser_detail'=>'无',
			'brandser_mdetail'=>'无',
			'brandser_add_date'=>0,
			'brandser_admin_id'=>0,
			'brandser_business_id'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO brand_series (id,brandser_name,brandser_pinyin,brandser_en,brand_id,brandser_detail,brandser_mdetail,brandser_add_date,brandser_admin_id,brandser_business_id,is_del) VALUES (NULL,:brandser_name,:brandser_pinyin,:brandser_en,:brand_id,:brandser_detail,:brandser_mdetail,:brandser_add_date,:brandser_admin_id,:brandser_business_id,:is_del)";
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