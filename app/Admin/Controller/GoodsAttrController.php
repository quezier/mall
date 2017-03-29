<?php
namespace App\Admin\Controller;
use App\Logic\GoodsAttrLogic;
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
        $needFieldsResult = $this->goodsAttrLogic->getNeedFields(array('id'));

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
        $needFieldsResult = $this->goodsAttrLogic->getNeedFields(array('id'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $addFields = array(
            'id'=>array('cn_name'=>$needFields['id'],'type'=>'text')
        );

        $this->setVariable('tableCName','商品属性');
        $this->setVariable('addFields',$addFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doaddgoodsatt");
        $this->displayAdd();
    }

    function toEditGoodsAttr(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->goodsAttrLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        $isDel = PubFunc::ddConfig('is_del');

        $needFieldsResult = $this->goodsAttrLogic->getNeedFields(array('is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>$isDel),
        );
        $this->setVariable('tableCName','商品属性');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditgoodsatt");
        $this->displayEdit();
    }

    function pageGoodsAttrList()
    {
        $rs = $this->goodsAttrLogic->pageGoodsAttrList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddGoodsAttr()
    {
        $rs = $this->goodsAttrLogic->insertFromTestData($_POST);
        echo json_encode($rs);exit;
    }

    function doEditGoodsAttr()
    {
        $rs = $this->goodsAttrLogic->update($_POST);
        echo json_encode($rs);exit;
    }
}