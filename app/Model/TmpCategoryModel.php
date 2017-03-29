<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class TmpCategoryModel extends BaseModel{
	public $fields=array(
		'id'=>'自动编号',
		'parent_id'=>'上级id',
		'name'=>'类目名称',
		'cm_pid'=>'草莓网父级id',
		'cm_id'=>'草莓网分类id',
		'is_cm'=>'是否草莓网分类',
		'sort'=>'排序',
		'is_hidden'=>'是否隐藏',
		'desc'=>'备注',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'tmp_category';
        $this->_validateRuleArray = array(
			'parent_id'=>array('rule'=>'/^-{0,1}[0-9]{1,20}$/','tip'=>'上级id的值必须是整数且,最大长度20'),
			'name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'类目名称的值必须是字符且,最大长度50'),
			'cm_pid'=>array('rule'=>'/^-{0,0}[0-9]{1,20}$/','tip'=>'草莓网父级id的值必须是整数且必须是正数,最大长度20'),
			'cm_id'=>array('rule'=>'/^-{0,0}[0-9]{1,20}$/','tip'=>'草莓网分类id的值必须是整数且必须是正数,最大长度20'),
			'is_cm'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否草莓网分类的值必须是整数且,最大长度1'),
			'sort'=>array('rule'=>'/^-{0,1}[0-9]{1,5}$/','tip'=>'排序的值必须是整数且,最大长度5'),
			'is_hidden'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否隐藏的值必须是整数且,最大长度1'),
			'desc'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'备注的值必须是字符且,最大长度255'),
			'is_del'=>array('rule'=>'/^-{0,0}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且必须是正数,最大长度1')
		);

        $this->_testData = array(
			'parent_id'=>0,
			'name'=>'无',
			'cm_pid'=>0,
			'cm_id'=>0,
			'is_cm'=>0,
			'sort'=>0,
			'is_hidden'=>0,
			'desc'=>'无',
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO tmp_category (id,parent_id,name,cm_pid,cm_id,is_cm,sort,is_hidden,desc,is_del) VALUES (NULL,:parent_id,:name,:cm_pid,:cm_id,:is_cm,:sort,:is_hidden,:desc,:is_del)";
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