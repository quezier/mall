<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class GoodsAttrModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'goodsattr_name'=>'属性名',
		'goodsattr_value'=>'属性值',
		'goods_category_id'=>'商品分类id',
		'goodsattr_add_date'=>'添加时间',
		'goodsattr_admin_id'=>'发布人(管理员)',
		'goodsattr_busniess_id'=>'发布人(商家)',
		'goodsattr_edit_date'=>'最后更新时间',
		'goodsattr_sort'=>'排序',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'goods_attr';
        $this->_validateRuleArray = array(
			'goodsattr_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'属性名的值必须是字符且,最大长度100'),
			'goodsattr_value'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'属性值的值必须是字符且,最大长度500'),
			'goods_category_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'商品分类id的值必须是整数且必须是正数,最大长度11'),
			'goodsattr_add_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'添加时间的值必须是整数且必须是正数,最大长度11'),
			'goodsattr_admin_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(管理员)的值必须是整数且必须是正数,最大长度11'),
			'goodsattr_busniess_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(商家)的值必须是整数且必须是正数,最大长度11'),
			'goodsattr_edit_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'最后更新时间的值必须是整数且必须是正数,最大长度11'),
			'goodsattr_sort'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'排序的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'goodsattr_name'=>'无',
			'goodsattr_value'=>'无',
			'goods_category_id'=>0,
			'goodsattr_add_date'=>0,
			'goodsattr_admin_id'=>0,
			'goodsattr_busniess_id'=>0,
			'goodsattr_edit_date'=>0,
			'goodsattr_sort'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO goods_attr (id,goodsattr_name,goodsattr_value,goods_category_id,goodsattr_add_date,goodsattr_admin_id,goodsattr_busniess_id,goodsattr_edit_date,goodsattr_sort,is_del) VALUES (NULL,:goodsattr_name,:goodsattr_value,:goods_category_id,:goodsattr_add_date,:goodsattr_admin_id,:goodsattr_busniess_id,:goodsattr_edit_date,:goodsattr_sort,:is_del)";
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