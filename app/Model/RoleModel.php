<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class RoleModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'role_name'=>'角色名',
		'user_id'=>'添加人id',
		'edit_id'=>'最后编辑人id',
		'add_date'=>'添加时间',
		'edit_date'=>'最后修改时间',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'role';
        $this->_validateRuleArray = array(
			'role_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'角色名的值必须是字符且,最大长度100'),
			'user_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'添加人id的值必须是整数且必须是正数,最大长度11'),
			'edit_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'最后编辑人id的值必须是整数且必须是正数,最大长度11'),
			'add_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'添加时间的值必须是整数且必须是正数,最大长度11'),
			'edit_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'最后修改时间的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,0}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且必须是正数,最大长度1')
		);

        $this->_testData = array(
			'role_name'=>'无',
			'user_id'=>0,
			'edit_id'=>0,
			'add_date'=>0,
			'edit_date'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO role (id,role_name,user_id,edit_id,add_date,edit_date,is_del) VALUES (NULL,:role_name,:user_id,:edit_id,:add_date,:edit_date,:is_del)";
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