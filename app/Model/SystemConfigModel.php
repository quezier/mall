<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class SystemConfigModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'config_name'=>'名称',
		'en_name'=>'英文名称',
		'config_value'=>'值',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'system_config';
        $this->_validateRuleArray = array(
			'config_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'名称的值必须是字符且,最大长度20'),
			'en_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'英文名称的值必须是字符且,最大长度50'),
			'config_value'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'值的值必须是字符且,最大长度100'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'config_name'=>'无',
			'en_name'=>'无',
			'config_value'=>'无',
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO system_config (id,config_name,en_name,config_value,is_del) VALUES (NULL,:config_name,:en_name,:config_value,:is_del)";
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