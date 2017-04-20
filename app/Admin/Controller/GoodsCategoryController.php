<?php
namespace App\Admin\Controller;
use App\Logic\GoodsCategoryLogic;
use Core\BaseController;
use Core\PubFunc;
class GoodsCategoryController extends BaseController
{
    private $goodsCategoryLogic;
    function __construct()
    {
        parent::__construct();
        $this->goodsCategoryLogic = new GoodsCategoryLogic();
    }
    function doGetGoodsCateByPid()
    {
        $pid = !empty($_GET['pid'])?intval($_GET['pid']):0;
        $rs = $this->goodsCategoryLogic->getByParentID($pid);
        echo json_encode($rs);exit;
    }

    function toGoodsCategoryList(){
        $needFieldsResult = $this->goodsCategoryLogic->getNeedFields(array('id','goodscate_name','goodscate_pinyin','goodscate_en','goodscate_parent_id','goodscate_add_date','is_del'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }

        $tableTitleButtons = array(
            '添加'=>HTTP_DOMAIN.'/admin_toaddgoodscat/last_url/'.trim(PATH,'/')
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toeditgoodscat/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'eq_id'=>array('type'=>'text','name'=>'序号')
        );
        $this->setVariable('tableCName','商品分类');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pagegoodscatlist");
        $this->displayList();
    }

    function toAddGoodsCategory(){
        $needFieldsResult = $this->goodsCategoryLogic->getNeedFields(array('goodscate_parent_id','goodscate_name','goodscate_pinyin','goodscate_en','goodscate_sort_order'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $parentIDList=$this->goodsCategoryLogic->getAll();
        $goodscateList=PubFunc::getSelectData($parentIDList['result'],'goodscate_name');
        $needFields = $needFieldsResult['result'];
        $addFields = array(
            'goodscate_parent_id'=>array('cn_name'=>$needFields['goodscate_parent_id'],'type'=>'select','list'=>$goodscateList),
            'goodscate_name'=>array('cn_name'=>$needFields['goodscate_name'],'type'=>'text'),
            'goodscate_pinyin'=>array('cn_name'=>$needFields['goodscate_pinyin'],'type'=>'text'),
            'goodscate_en'=>array('cn_name'=>$needFields['goodscate_en'],'type'=>'text'),
            'goodscate_sort_order'=>array('cn_name'=>$needFields['goodscate_sort_order'],'type'=>'text'),
        );

        $this->setVariable('tableCName','商品分类');
        $this->setVariable('addFields',$addFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doaddgoodscat");
        $this->displayAdd();
    }

    function toEditGoodsCategory(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->goodsCategoryLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        $isDel = PubFunc::ddConfig('is_del');
        $parentIDList=$this->goodsCategoryLogic->getAll();
        $goodscateList=PubFunc::getSelectData($parentIDList['result'],'goodscate_name');
        $needFieldsResult = $this->goodsCategoryLogic->getNeedFields(array('goodscate_parent_id','goodscate_name','goodscate_pinyin','goodscate_en','goodscate_sort_order','is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'goodscate_parent_id'=>array('cn_name'=>$needFields['goodscate_parent_id'],'type'=>'select','list'=>$goodscateList),
            'goodscate_name'=>array('cn_name'=>$needFields['goodscate_name'],'type'=>'text'),
            'goodscate_pinyin'=>array('cn_name'=>$needFields['goodscate_pinyin'],'type'=>'text'),
            'goodscate_en'=>array('cn_name'=>$needFields['goodscate_en'],'type'=>'text'),
            'goodscate_sort_order'=>array('cn_name'=>$needFields['goodscate_sort_order'],'type'=>'text'),
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>$isDel),
        );
        $this->setVariable('tableCName','商品分类');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditgoodscat");
        $this->displayEdit();
    }

    function pageGoodsCategoryList()
    {
        $rs = $this->goodsCategoryLogic->pageGoodsCategoryList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddGoodsCategory()
    {
        $_POST['goodscate_add_date']=time();
        $rs = $this->goodsCategoryLogic->insertFromTestData($_POST);
        echo json_encode($rs);exit;
    }

    function doEditGoodsCategory()
    {
        $_POST['goodscate_add_date']=time();
        $rs = $this->goodsCategoryLogic->update($_POST);
        echo json_encode($rs);exit;
    }
}