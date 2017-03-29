<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class DataDictionaryTypeModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'ddtype_no'=>'字典类型编号',
		'name'=>'名称',
		'sort'=>'排序',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'data_dictionary_type';
        $this->_validateRuleArray = array(
			'ddtype_no'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'字典类型编号的值必须是整数且必须是正数,最大长度11'),
			'name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'名称的值必须是字符且,最大长度100'),
			'sort'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'排序的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,0}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且必须是正数,最大长度1')
		);

        $this->_testData = array(
			'ddtype_no'=>0,
			'name'=>'无',
			'sort'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO data_dictionary_type (id,ddtype_no,name,sort,is_del) VALUES (NULL,:ddtype_no,:name,:sort,:is_del)";
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