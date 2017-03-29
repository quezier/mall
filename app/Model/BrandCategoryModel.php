<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class BrandCategoryModel extends BaseModel{
	public $fields=array(
		'id'=>'',
		'brand_id'=>'品牌表id',
		'category_id'=>'分类表id',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'brand_category';
        $this->_validateRuleArray = array(
			'brand_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'品牌表id的值必须是整数且必须是正数,最大长度11'),
			'category_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'分类表id的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'brand_id'=>0,
			'category_id'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO brand_category (id,brand_id,category_id,is_del) VALUES (NULL,:brand_id,:category_id,:is_del)";
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