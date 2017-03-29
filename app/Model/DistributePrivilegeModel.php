<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class DistributePrivilegeModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'role_id'=>'角色id',
		'privilege_id'=>'权限表id',
		'add_date'=>'添加时间',
		'edit_date'=>'编辑时间',
		'add_admin_id'=>'添加人id',
		'edit_admin_id'=>'编辑人id',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'distribute_privilege';
        $this->_validateRuleArray = array(
			'role_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'角色id的值必须是整数且必须是正数,最大长度11'),
			'privilege_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'权限表id的值必须是整数且必须是正数,最大长度11'),
			'add_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'添加时间的值必须是整数且必须是正数,最大长度11'),
			'edit_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'编辑时间的值必须是整数且必须是正数,最大长度11'),
			'add_admin_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'添加人id的值必须是整数且必须是正数,最大长度11'),
			'edit_admin_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'编辑人id的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,0}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且必须是正数,最大长度1')
		);

        $this->_testData = array(
			'role_id'=>0,
			'privilege_id'=>0,
			'add_date'=>0,
			'edit_date'=>0,
			'add_admin_id'=>0,
			'edit_admin_id'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO distribute_privilege (id,role_id,privilege_id,add_date,edit_date,add_admin_id,edit_admin_id,is_del) VALUES (NULL,:role_id,:privilege_id,:add_date,:edit_date,:add_admin_id,:edit_admin_id,:is_del)";
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