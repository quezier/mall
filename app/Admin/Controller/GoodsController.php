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

        $needFieldsResult = $this->goodsLogic->getNeedFields(array('goods_name','goods_market_price',
            'goods_shop_price','goods_promote_price','goods_weight','goods_number','goods_warn_number',
            'goods_is_real','goods_is_gift','goods_is_best','goods_is_new','goods_is_hot','goods_is_promote',
            'goods_sort','is_del'));

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
            'like_goods_goods_name'=>array('type'=>'text','name'=>'商品名称')
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
        $rs = $this->goodsLogic->getForEdit($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result'][0]);
        }
        $isDel = PubFunc::ddConfig('is_del');
        $goodsIsReal = PubFunc::ddConfig('goods_is_real');
        $goodsIsGift = PubFunc::ddConfig('goods_is_gift');
        $goodsIsBest = PubFunc::ddConfig('goods_is_best');
        $goodsIsHot = PubFunc::ddConfig('goods_is_hot');
        $goodsIsPromote = PubFunc::ddConfig('goods_is_promote');
        $goodsIsNew = PubFunc::ddConfig('goods_is_new');
        $needFieldsResult = $this->goodsLogic->getNeedFields(array('goods_name','goods_name_css','goods_market_price',
            'goods_shop_price','goods_promote_price','goods_weight','goods_number','goods_warn_number','goods_key',
            'goods_brief','goods_is_real','goods_is_gift','goods_is_best','goods_is_new','goods_is_hot','goods_is_promote',
            'goods_sort','is_del'));
        if($needFieldsResult['status']==2)
        {
            $this->toTip('未获取到字段',HTTP_DOMAIN.'/admin_tolistgoods');exit;
        }
        $needFields = $needFieldsResult['result'];
        $needFields['goodscate_name'] = '商品类型';
        $needFields['brand_name'] = '品牌';
        $needFields['brandser_name'] = '品牌系列';
        $editFields = array(
            'goodscate_name'=>array('cn_name'=>$needFields['goodscate_name'],'type'=>'text','no_use'=>true),
            'brand_name'=>array('cn_name'=>$needFields['brand_name'],'type'=>'text','no_use'=>true),
            'brandser_name'=>array('cn_name'=>$needFields['brandser_name'],'type'=>'text','no_use'=>true),
            'goods_name'=>array('cn_name'=>$needFields['goods_name'],'type'=>'text'),
            'goods_name_css'=>array('cn_name'=>$needFields['goods_name_css'],'type'=>'text'),
            'goods_market_price'=>array('cn_name'=>$needFields['goods_market_price'],'type'=>'text'),
            'goods_shop_price'=>array('cn_name'=>$needFields['goods_shop_price'],'type'=>'text'),
            'goods_promote_price'=>array('cn_name'=>$needFields['goods_promote_price'],'type'=>'text'),
            'goods_weight'=>array('cn_name'=>$needFields['goods_weight'],'type'=>'text'),
            'goods_number'=>array('cn_name'=>$needFields['goods_number'],'type'=>'text'),
            'goods_warn_number'=>array('cn_name'=>$needFields['goods_warn_number'],'type'=>'text'),
            'goods_key'=>array('cn_name'=>$needFields['goods_key'],'type'=>'text'),
            'goods_brief'=>array('cn_name'=>$needFields['goods_brief'],'type'=>'text'),
            'goods_is_real'=>array('cn_name'=>$needFields['goods_is_real'],'type'=>'radio','list'=>$goodsIsReal),
            'goods_is_gift'=>array('cn_name'=>$needFields['goods_is_gift'],'type'=>'radio','list'=>$goodsIsGift),
            'goods_is_best'=>array('cn_name'=>$needFields['goods_is_best'],'type'=>'radio','list'=>$goodsIsBest),
            'goods_is_new'=>array('cn_name'=>$needFields['goods_is_new'],'type'=>'radio','list'=>$goodsIsNew),
            'goods_is_hot'=>array('cn_name'=>$needFields['goods_is_hot'],'type'=>'radio','list'=>$goodsIsHot),
            'goods_is_promote'=>array('cn_name'=>$needFields['goods_is_promote'],'type'=>'radio','list'=>$goodsIsPromote),
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
        if($rs['status']==1&&!empty($rs['result']))
        {
            $goodsIsReal = PubFunc::ddConfig('goods_is_real');
            $goodsIsGift = PubFunc::ddConfig('goods_is_gift');
            $goodsIsBest = PubFunc::ddConfig('goods_is_best');
            $goodsIsHot = PubFunc::ddConfig('goods_is_hot');
            $goodsIsPromote = PubFunc::ddConfig('goods_is_promote');
            $goodsIsNew = PubFunc::ddConfig('goods_is_new');
            foreach ($rs['result']['list'] as $key => $val)
            {
                $rs['result']['list'][$key]['goods_is_real']= $goodsIsReal[$val['goods_is_real']];
                $rs['result']['list'][$key]['goods_is_gift']= $goodsIsGift[$val['goods_is_gift']];
                $rs['result']['list'][$key]['goods_is_best']= $goodsIsBest[$val['goods_is_best']];
                $rs['result']['list'][$key]['goods_is_hot']= $goodsIsHot[$val['goods_is_hot']];
                $rs['result']['list'][$key]['goods_is_promote']= $goodsIsPromote[$val['goods_is_promote']];
                $rs['result']['list'][$key]['goods_is_new']= $goodsIsNew[$val['goods_is_new']];
            }
        }
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
        $_POST['goods_edit_adminid']=PubFunc::session('admin_id');
        $_POST['goods_edit_date']=time();
        $rs = $this->goodsLogic->update($_POST);
        echo json_encode($rs);exit;
    }
}