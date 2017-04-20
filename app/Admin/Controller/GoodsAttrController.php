<?php
namespace App\Admin\Controller;
use App\Logic\GoodsAttrLogic;
use App\Logic\GoodsCategoryLogic;
use Core\BaseController;
use Core\PubFunc;
class GoodsAttrController extends BaseController
{
    private $goodsAttrLogic;
    function __construct()
    {
        parent::__construct();
        $this->goodsAttrLogic = new GoodsAttrLogic();
    }

    function doGetGoodsAttrByCateID()
    {
        $cateID = !empty($_GET['cate_id'])?intval($_GET['cate_id']):0;
        $rs = $this->goodsAttrLogic->getByCateID($cateID);
        if (!empty($rs['result']) && count($rs['result']) > 0) {
            foreach ($rs['result'] as $key => $value) {
                $rs['result'][$key]['values'] = explode('|', $value['goodsattr_value']);
            }
        }
        echo json_encode($rs);exit;
    }
    function toGoodsAttrList(){
        $needFieldsResult = $this->goodsAttrLogic->getNeedFields(array('id','goodsattr_name','goodsattr_value','goods_category_id','goodsattr_add_date','goodsattr_admin_id','is_del'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }

        $tableTitleButtons = array(
            '添加'=>HTTP_DOMAIN.'/admin_toaddgoodsatt/last_url/'.trim(PATH,'/')
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toeditgoodsatt/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'eq_id'=>array('type'=>'text','name'=>'序号')
        );
        $this->setVariable('tableCName','商品属性');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pagegoodsattlist");
        $this->displayList();
    }

    function toAddGoodsAttr(){
        //根据品牌里外键商品分类ID查找商品分类名称
        $gclogic=new GoodsCategoryLogic();
        $topCategory = $gclogic->getTop();
        $this->setVariable('topCategory', $topCategory['result']);

        $this->setVariable('tableCName','商品属性');
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doaddgoodsatt");
        $this->display();
    }

    function toEditGoodsAttr(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->goodsAttrLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        //根据品牌里外键商品分类ID查找商品分类名称
        $gclogic=new GoodsCategoryLogic();
        $topCategory = $gclogic->getTop();
        $goodscate = $gclogic->getOne('','where is_del=1 and id=:goods_category_id',array('goods_category_id' => $rs['result']['goods_category_id']));
        $this->setVariable('topCategory', $topCategory['result']);
        $this->setVariable('goodscate_name', $goodscate['result']);
        $this->setVariable('tableCName','商品属性');
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditgoodsatt");
        $this->display();
    }

    function pageGoodsAttrList()
    {
        $rs = $this->goodsAttrLogic->pageGoodsAttrList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddGoodsAttr()
    {
        $goodsattrLogic = new GoodsAttrLogic();
        $data = $_POST;
        $data['goodsattr_admin_id'] = PubFunc::session('admin_id');
        $data['goods_category_id'] = $_POST['category_id'];
        $data['goodsattr_add_date'] = time();
        $result = $goodsattrLogic->insertFromTestData($data);
        echo json_encode($result);exit;
    }

    function doEditGoodsAttr()
    {
        $data = $_POST;
        $data['goodsattr_edit_date'] = time();
        $data['goods_category_id'] = $_POST['category_id'];
        $rs = $this->goodsAttrLogic->update($data);
        echo json_encode($rs);exit;
    }
}