<?php 
namespace App\Model;
use Core\BaseModel;
use Core\PdoHelper;
class GoodsModel extends BaseModel{
	public $fields=array(
		'id'=>'主键',
		'category_id'=>'商品分类id',
		'goods_sn'=>'商品编号',
		'goods_name'=>'商品名称',
		'goods_attr_values'=>'商品属性值',
		'goods_name_css'=>'商品名称的css样式',
		'brand_id'=>'品牌id',
		'brand_series_id'=>'品牌系列id',
		'goods_number'=>'商品数量',
		'goods_weight'=>'商品重量',
		'goods_market_price'=>'市场价',
		'goods_shop_price'=>'零售价',
		'goods_promote_price'=>'促销价',
		'goods_warn_number'=>'商品默认报警数量',
		'goods_key'=>'商品关键词',
		'goods_brief'=>'商品简单描述',
		'goods_text'=>'商品描述',
		'goods_thumb'=>'商品缩略图',
		'goods_img'=>'商品图',
		'goods_is_real'=>'是否实物',
		'goods_is_sale'=>'是否在售',
		'goods_is_gift'=>'是否附赠礼品',
		'goods_is_best'=>'是否推荐',
		'goods_is_new'=>'是否新品',
		'goods_is_hot'=>'是否热销',
		'goods_is_promote'=>'是否特价',
		'goods_add_date'=>'添加时间',
		'goods_sort'=>'排序',
		'goods_admin_id'=>'发布人(管理员)',
		'goods_business_id'=>'发布人(商家)',
		'goods_edit_adminid'=>'最后编辑人(管理员)',
		'goods_edit_businessid'=>'最后编辑人(商家)',
		'goods_edit_date'=>'最后编辑时间',
		'is_del'=>'是否可用',
	);
	public $pk='id';
    function __construct($inputPdoHelper = NULL){
        parent::__construct($inputPdoHelper);
        $this->tableName = 'goods';
        $this->_validateRuleArray = array(
			'category_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'商品分类id的值必须是整数且必须是正数,最大长度11'),
			'goods_sn'=>array('rule'=>'/^-{0,0}[0-9]{1,32}$/','tip'=>'商品编号的值必须是整数且必须是正数,最大长度32'),
			'goods_name'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品名称的值必须是字符且,最大长度200'),
			'goods_attr_values'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品属性值的值必须是字符且,最大长度500'),
			'goods_name_css'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品名称的css样式的值必须是字符且,最大长度200'),
			'brand_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'品牌id的值必须是整数且必须是正数,最大长度11'),
			'brand_series_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'品牌系列id的值必须是整数且必须是正数,最大长度11'),
			'goods_number'=>array('rule'=>'/^-{0,1}[0-9]{1,11}$/','tip'=>'商品数量的值必须是整数且,最大长度11'),
			'goods_weight'=>array('rule'=>'/^-{0,1}[0-9]{1,8}\.{0,1}[0-9]{0,2}$/','tip'=>'商品重量的值必须是小数且,最大长度10'),
			'goods_market_price'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'市场价的值必须是小数且,最大长度11'),
			'goods_shop_price'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'零售价的值必须是小数且,最大长度11'),
			'goods_promote_price'=>array('rule'=>'/^-{0,1}[0-9]{1,9}\.{0,1}[0-9]{0,2}$/','tip'=>'促销价的值必须是小数且,最大长度11'),
			'goods_warn_number'=>array('rule'=>'/^-{0,0}[0-9]{1,10}\.{0,1}[0-9]{0,0}$/','tip'=>'商品默认报警数量的值必须是小数且必须是正数,最大长度10'),
			'goods_key'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品关键词的值必须是字符且,最大长度200'),
			'goods_brief'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品简单描述的值必须是字符且,最大长度200'),
			'goods_text'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品描述的值必须是字符且,最大长度0'),
			'goods_thumb'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品缩略图的值必须是字符且,最大长度200'),
			'goods_img'=>array('rule'=>'/^(.*){1,1}$/','tip'=>'商品图的值必须是字符且,最大长度200'),
			'goods_is_real'=>array('rule'=>'/^-{0,0}[0-9]{1,1}$/','tip'=>'是否实物的值必须是整数且必须是正数,最大长度1'),
			'goods_is_sale'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否在售的值必须是整数且,最大长度1'),
			'goods_is_gift'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否附赠礼品的值必须是整数且,最大长度1'),
			'goods_is_best'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否推荐的值必须是整数且,最大长度1'),
			'goods_is_new'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否新品的值必须是整数且,最大长度1'),
			'goods_is_hot'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否热销的值必须是整数且,最大长度1'),
			'goods_is_promote'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否特价的值必须是整数且,最大长度1'),
			'goods_add_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'添加时间的值必须是整数且必须是正数,最大长度11'),
			'goods_sort'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'排序的值必须是整数且必须是正数,最大长度11'),
			'goods_admin_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(管理员)的值必须是整数且必须是正数,最大长度11'),
			'goods_business_id'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'发布人(商家)的值必须是整数且必须是正数,最大长度11'),
			'goods_edit_adminid'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'最后编辑人(管理员)的值必须是整数且必须是正数,最大长度11'),
			'goods_edit_businessid'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'最后编辑人(商家)的值必须是整数且必须是正数,最大长度11'),
			'goods_edit_date'=>array('rule'=>'/^-{0,0}[0-9]{1,11}$/','tip'=>'最后编辑时间的值必须是整数且必须是正数,最大长度11'),
			'is_del'=>array('rule'=>'/^-{0,1}[0-9]{1,1}$/','tip'=>'是否可用的值必须是整数且,最大长度1')
		);

        $this->_testData = array(
			'category_id'=>0,
			'goods_sn'=>0,
			'goods_name'=>'无',
			'goods_attr_values'=>'无',
			'goods_name_css'=>'无',
			'brand_id'=>0,
			'brand_series_id'=>0,
			'goods_number'=>0,
			'goods_weight'=>0.0,
			'goods_market_price'=>0.0,
			'goods_shop_price'=>0.0,
			'goods_promote_price'=>0.0,
			'goods_warn_number'=>0.0,
			'goods_key'=>'无',
			'goods_brief'=>'无',
			'goods_text'=>'无',
			'goods_thumb'=>'无',
			'goods_img'=>'无',
			'goods_is_real'=>0,
			'goods_is_sale'=>0,
			'goods_is_gift'=>0,
			'goods_is_best'=>0,
			'goods_is_new'=>0,
			'goods_is_hot'=>0,
			'goods_is_promote'=>0,
			'goods_add_date'=>0,
			'goods_sort'=>0,
			'goods_admin_id'=>0,
			'goods_business_id'=>0,
			'goods_edit_adminid'=>0,
			'goods_edit_businessid'=>0,
			'goods_edit_date'=>0,
			'is_del'=>1
		);

    }
	public function insertTest(){
		$sql = "INSERT INTO goods (id,category_id,goods_sn,goods_name,goods_attr_values,goods_name_css,brand_id,brand_series_id,goods_number,goods_weight,goods_market_price,goods_shop_price,goods_promote_price,goods_warn_number,goods_key,goods_brief,goods_text,goods_thumb,goods_img,goods_is_real,goods_is_sale,goods_is_gift,goods_is_best,goods_is_new,goods_is_hot,goods_is_promote,goods_add_date,goods_sort,goods_admin_id,goods_business_id,goods_edit_adminid,goods_edit_businessid,goods_edit_date,is_del) VALUES (NULL,:category_id,:goods_sn,:goods_name,:goods_attr_values,:goods_name_css,:brand_id,:brand_series_id,:goods_number,:goods_weight,:goods_market_price,:goods_shop_price,:goods_promote_price,:goods_warn_number,:goods_key,:goods_brief,:goods_text,:goods_thumb,:goods_img,:goods_is_real,:goods_is_sale,:goods_is_gift,:goods_is_best,:goods_is_new,:goods_is_hot,:goods_is_promote,:goods_add_date,:goods_sort,:goods_admin_id,:goods_business_id,:goods_edit_adminid,:goods_edit_businessid,:goods_edit_date,:is_del)";
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