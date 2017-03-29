<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class CommentModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'article_id'=>'文章id',
		'content'=>'内容',
		'pub_date'=>'发布时间',
		'user_id'=>'评论人id',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'comment';
        $this->_validateRuleArray = array(
			'article_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'文章id的值必须是整数且必须是正数,最大长度11'),
			'content'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'内容的值必须是字符且,最大长度100'),
			'pub_date'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'发布时间的值必须是整数且,最大长度11'),
			'user_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'评论人id的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,0}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且必须是正数,最大长度1')
		);

        $this->_testData = array(
			'article_id'=>0,
			'content'=>'无',
			'pub_date'=>0,
			'user_id'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO comment (id,article_id,content,pub_date,user_id,is_del) VALUES (NULL,:article_id,:content,:pub_date,:user_id,:is_del)";
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