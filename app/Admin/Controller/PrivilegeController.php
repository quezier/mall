<?php


namespace App\Admin\Controller;


use Core\BaseController;
use App\Logic\PrivilegeLogic;
use Core\PubFunc;

class PrivilegeController extends BaseController
{
    private $privilegeLogic;
    function __construct()
    {
        parent::__construct();
        $this->privilegeLogic = new PrivilegeLogic();
    }

    function toPrivilegeList(){
        $needFieldsResult = $this->privilegeLogic->getNeedFields(array('id','privilege_name','privilege_url','rank_num','parent_id','is_del'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }

        $tableTitleButtons = array(
            '添加'=>HTTP_DOMAIN.'/admin_toaddprivilege/last_url/'.trim(PATH,'/'),
            '自动添加'=>HTTP_DOMAIN.'/admin_doautoaddprivilege'
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toeditprivilege/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'like_privilege_name'=>array('type'=>'text','name'=>'权限名'),
            'like_privilege_url'=>array('type'=>'text','name'=>'权限路径'),
        );
        $this->setVariable('tableCName','权限');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pageprivilegelist");
        $this->displayList();
    }

    function toAddPrivilege(){
        $needFieldsResult = $this->privilegeLogic->getNeedFields(array('privilege_name','privilege_url',
            'privilege_type','privilege_css','privilege_sort','rank_num','parent_id'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $configData = PubFunc::config('data_dictionary');
        $typeData = $configData['privilege_type'];
        $addFields = array(
            'privilege_name'=>array('cn_name'=>$needFields['privilege_name'],'type'=>'text'),
            'privilege_url'=>array('cn_name'=>$needFields['privilege_url'],'type'=>'text'),
            'privilege_type'=>array('cn_name'=>$needFields['privilege_type'],'type'=>'radio','list'=>$typeData),
            'privilege_css'=>array('cn_name'=>$needFields['privilege_css'],'type'=>'text'),
            'privilege_sort'=>array('cn_name'=>$needFields['privilege_sort'],'type'=>'text'),
            'rank_num'=>array('cn_name'=>$needFields['rank_num'],'type'=>'text'),
            'parent_id'=>array('cn_name'=>$needFields['parent_id'],'type'=>'text')
        );

        $this->setVariable('tableCName','权限');
        $this->setVariable('addFields',$addFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doaddprivilege");
        $this->displayAdd();
    }

    function toEditPrivilege(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->privilegeLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        $dataConfig = PubFunc::config('data_dictionary');
        $typeData = $dataConfig['privilege_type'];
        $needFieldsResult = $this->privilegeLogic->getNeedFields(array('privilege_name','privilege_url',
            'privilege_type','privilege_css','privilege_sort','rank_num','parent_id','is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'privilege_name'=>array('cn_name'=>$needFields['privilege_name'],'type'=>'text'),
            'privilege_url'=>array('cn_name'=>$needFields['privilege_url'],'type'=>'text'),
            'privilege_type'=>array('cn_name'=>$needFields['privilege_type'],'type'=>'radio','list'=>$typeData),
            'privilege_css'=>array('cn_name'=>$needFields['privilege_css'],'type'=>'text'),
            'privilege_sort'=>array('cn_name'=>$needFields['privilege_sort'],'type'=>'text'),
            'rank_num'=>array('cn_name'=>$needFields['rank_num'],'type'=>'text'),
            'parent_id'=>array('cn_name'=>$needFields['parent_id'],'type'=>'text'),
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>$dataConfig['is_del']),
        );
        $this->setVariable('tableCName','权限');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditprivilege");
        $this->displayEdit();
    }

    function pagePrivilegeList()
    {
        $rs = $this->privilegeLogic->pagePrivilegeList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddPrivilege()
    {
        $rs = $this->privilegeLogic->insertFromTestData($_POST);
        echo json_encode($rs);exit;
    }

    function doEditPrivilege()
    {
        $rs = $this->privilegeLogic->update($_POST);
        echo json_encode($rs);exit;
    }

    function doAutoAddPrivilege()
    {
        $rs = $this->privilegeLogic->autoAdd();
        $this->toTip($rs['msg'],HTTP_DOMAIN.'/admin_tolistprivilege');exit;
    }
}