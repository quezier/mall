<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class DataDictionaryModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'datadictionarytype_id'=>'数据字典类型',
		'datadictionarytype_name'=>'数据字典类型名',
		'value_desc'=>'值说明',
		'ddmark'=>'备注',
		'sort'=>'排序',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'data_dictionary';
        $this->_validateRuleArray = array(
			'datadictionarytype_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'数据字典类型的值必须是整数且必须是正数,最大长度11'),
			'datadictionarytype_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'数据字典类型名的值必须是字符且,最大长度100'),
			'value_desc'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'值说明的值必须是字符且,最大长度50'),
			'ddmark'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'备注的值必须是字符且,最大长度500'),
			'sort'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'排序的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'datadictionarytype_id'=>0,
			'datadictionarytype_name'=>'无',
			'value_desc'=>'无',
			'ddmark'=>'无',
			'sort'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO data_dictionary (id,datadictionarytype_id,datadictionarytype_name,value_desc,ddmark,sort,is_del) VALUES (NULL,:datadictionarytype_id,:datadictionarytype_name,:value_desc,:ddmark,:sort,:is_del)";
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