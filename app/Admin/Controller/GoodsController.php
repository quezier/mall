<?php
namespace App\Admin\Controller;
use App\Logic\GoodsCategoryLogic;
use App\Logic\GoodsLogic;
use Core\BaseController;
use Core\PubFunc;
class GoodsController extends BaseController
{
    private $goodsLogic;
    private $goodsCategoryLogic;
    function __construct()
    {
        parent::__construct();
        $this->goodsLogic = new GoodsLogic();
        $this->goodsCategoryLogic = new GoodsCategoryLogic();
    }

    function toGoodsList(){
        $needFieldsResult = $this->goodsLogic->getNeedFields(array('id'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }

        $tableTitleButtons = array(
            '添加'=>HTTP_DOMAIN.'/admin_toaddgoods/last_url/'.trim(PATH,'/')
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toeditgoods/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'eq_id'=>array('type'=>'text','name'=>'序号')
        );
        $this->setVariable('tableCName','商品');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pagegoodslist");
        $this->displayList();
    }

    function toAddGoods(){
        $topGoodsCategoryResult = $this->goodsCategoryLogic->getTop();
        if($topGoodsCategoryResult['status']==2)
        {
            $this->toTip('查询顶级分类失败',HTTP_DOMAIN.'/admin_tolistgoods');exit;
        }
        $topGoodsCategories = $topGoodsCategoryResult['result'];
        $this->setVariable('top_gc',$topGoodsCategories);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doaddgoods");
        $this->display();
    }

    function toEditGoods(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->goodsLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        $isDel = PubFunc::ddConfig('is_del');

        $needFieldsResult = $this->goodsLogic->getNeedFields(array('is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>$isDel),
        );
        $this->setVariable('tableCName','商品');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditgoods");
        $this->displayEdit();
    }

    function pageGoodsList()
    {
        $rs = $this->goodsLogic->pageGoodsList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddGoods()
    {
        $_GET['goods_name_css'] = $_GET['goods_css'];
        $_GET['goods_admin_id'] = PubFunc::session('admin_id');
        $attr_array = json_decode(htmlspecialchars_decode($_GET['attrs']), true);
        $attrvalue_array = json_decode(htmlspecialchars_decode($_GET['g_va']));
        //echo json_encode($attrvalue_array);exit;
        $tmpGoodsName = $_GET['goods_name'];
        //foreach ($attr_array as $key => $val) {
        for ($i = 0; $i < count($attr_array); $i++) {
            $val = $attr_array[$i];
            $_GET['goods_name'] = $tmpGoodsName;
            $goods_attr_values = '';
            foreach ($val as $k => $v) {
                if ($k != '价格' && $k != '库存') {
                    $_GET['goods_name'].=' ' . $v;
                    $goods_attr_values.=$v . ' ';
                } elseif ($k == '价格') {
                    $_GET['goods_promote_price'] = $v;
                } elseif ($k == '库存') {
                    $_GET['goods_number'] = $v;
                }
            }
            //$data['goods_attr_values'] = rtrim($goods_attr_values, ' ');
            $_GET['goods_attr_values'] = json_encode($attrvalue_array[$i]);
            $_GET['goods_business_id'] = 0; //商家
            $_GET['goods_add_date']=time();
            $rs = $this->goodsLogic->insertFromTestData($_GET);
            if($rs['status']==2)
            {
                echo json_encode($rs);exit;
            }
        }
        echo json_encode(PubFunc::returnArray(1,false,'发布商品成功'));exit;
    }

    function doEditGoods()
    {
        $rs = $this->goodsLogic->update($_POST);
        echo json_encode($rs);exit;
    }
}