<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class GoodsGalleryModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'goods_id'=>'商品id',
		'goodsgallery_url'=>'图片路径',
		'goodsgallery_desc'=>'图片描述',
		'goodsgallery_thumb'=>'缩略图路径',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'goods_gallery';
        $this->_validateRuleArray = array(
			'goods_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'商品id的值必须是整数且必须是正数,最大长度11'),
			'goodsgallery_url'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'图片路径的值必须是字符且,最大长度200'),
			'goodsgallery_desc'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'图片描述的值必须是字符且,最大长度200'),
			'goodsgallery_thumb'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'缩略图路径的值必须是字符且,最大长度200'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'goods_id'=>0,
			'goodsgallery_url'=>'无',
			'goodsgallery_desc'=>'无',
			'goodsgallery_thumb'=>'无',
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO goods_gallery (id,goods_id,goodsgallery_url,goodsgallery_desc,goodsgallery_thumb,is_del) VALUES (NULL,:goods_id,:goodsgallery_url,:goodsgallery_desc,:goodsgallery_thumb,:is_del)";
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