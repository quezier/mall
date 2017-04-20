<?php
/**
 * Created by PhpStorm.
 * User: xyf
 * Date: 2017/4/14
 * Time: 15:04
 */

namespace App\Admin\Controller;


use App\Logic\UserAddressLogic;
use App\Logic\UserLogic;
use App\Model\UserAddressModel;
use App\Model\UserModel;
use Core\BaseController;
use Core\PubFunc;

class UserController extends BaseController
{
    private $userLogic;
    private $useraddressLogic;
    function __construct()
    {
        parent::__construct();
        $this->userLogic=new UserLogic();
        $this->useraddressLogic=new UserAddressLogic();
    }

    function toUserList(){
        $needFieldsResult = $this->userLogic->getNeedFields(array('id','user_mobile','user_name','user_email','user_sex','user_birthday','user_nick','is_del'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }
        $titleNames[0] = '序号';
        $tableTitleButtons = array(
            //'添加'=>HTTP_DOMAIN.'/admin_toaddarticleinf/last_url/'.trim(PATH,'/')
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toedituser/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'like_title'=>array('type'=>'text','name'=>'标题'),
            'like_user_mobile'=>array('type'=>'text','name'=>'手机号'),
        );
        $this->setVariable('tableCName','用户');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pageuserlist");
        $this->displayList();
    }

    function pageUserList()
    {
        $rs = $this->userLogic->pageUserList($_GET);
        if($rs['status']==1&&!empty($rs['result']))
        {
            foreach ($rs['result']['list'] as $key => $val)
            {
                $rs['result']['list'][$key]['user_birthday']= date('Y-m-d',$val['user_birthday']);
            }
        }
        echo json_encode($rs);exit;
    }

    function toEditUser(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->userLogic->getById($id);
        $user_birthday = date('Y-m-d',$rs['result']['user_birthday']);
        $rs['result']['user_birthday']=$user_birthday;
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }

        $needFieldsResult = $this->userLogic->getNeedFields(array('id','user_mobile','user_name','user_email','user_sex','user_birthday','user_nick','is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'user_mobile'=>array('cn_name'=>$needFields['user_mobile'],'type'=>'text'),
            'user_name'=>array('cn_name'=>$needFields['user_name'],'type'=>'text'),
            'user_email'=>array('cn_name'=>$needFields['user_email'],'type'=>'text'),
            'user_sex'=>array('cn_name'=>$needFields['user_email'],'type'=>'text'),
            'user_birthday'=>array('cn_name'=>$needFields['user_birthday'],'type'=>'date'),
            'user_nick'=>array('cn_name'=>$needFields['user_nick'],'type'=>'text'),
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>PubFunc::ddConfig('is_del'))
        );
        $this->setVariable('tableCName','用户');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doedituser");
        $this->displayEdit();
    }

    function doEditUser()
    {
        if(!empty($_POST['user_birthday']))
        {
            $_POST['user_birthday'] = strtotime($_POST['user_birthday']);
        }
        $rs = $this->userLogic->update($_POST);
        echo json_encode($rs);exit;
    }

    //收货地址开始
    function toUserAddressList(){
        $needFieldsResult = $this->useraddressLogic->getNeedFields(array('id','useraddr_name','useraddr_mobile','useraddr_email','useraddr_address','useraddr_sign_building','useraddr_best_date','useraddr_is_default','is_del'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }
        $titleNames[0] = '序号';
        $tableTitleButtons = array(
            //'添加'=>HTTP_DOMAIN.'/admin_toaddarticleinf/last_url/'.trim(PATH,'/')
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toedituseraddress/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'like_title'=>array('type'=>'text','name'=>'标题'),
            'like_user_mobile'=>array('type'=>'text','name'=>'手机号'),
        );
        $this->setVariable('tableCName','收货地址');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pageuseraddresslist");
        $this->displayList();
    }

    function pageUserAddressList()
    {
        $rs = $this->useraddressLogic->pageUserList($_GET);
        if($rs['status']==1&&!empty($rs['result']))
        {
            foreach ($rs['result']['list'] as $key => $val)
            {
                $rs['result']['list'][$key]['user_birthday']= date('Y-m-d',$val['user_birthday']);
            }
        }
        echo json_encode($rs);exit;
    }

    function toEditUserAddress(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->useraddressLogic->getById($id);
        $useraddr_best_date = date('Y-m-d',$rs['result']['useraddr_best_date']);
        $rs['result']['useraddr_best_date']=$useraddr_best_date;
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }

        $needFieldsResult = $this->useraddressLogic->getNeedFields(array('useraddr_name','useraddr_mobile','useraddr_email','useraddr_address','useraddr_sign_building','useraddr_best_date','useraddr_is_default','is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'useraddr_name'=>array('cn_name'=>$needFields['useraddr_name'],'type'=>'text'),
            'useraddr_mobile'=>array('cn_name'=>$needFields['useraddr_mobile'],'type'=>'text'),
            'useraddr_email'=>array('cn_name'=>$needFields['useraddr_email'],'type'=>'text'),
            'useraddr_address'=>array('cn_name'=>$needFields['useraddr_address'],'type'=>'text'),
            'useraddr_sign_building'=>array('cn_name'=>$needFields['useraddr_sign_building'],'type'=>'text'),
            'useraddr_best_date'=>array('cn_name'=>$needFields['useraddr_best_date'],'type'=>'date'),
            'useraddr_is_default'=>array('cn_name'=>$needFields['useraddr_is_default'],'type'=>'radio','list'=>PubFunc::ddConfig('useraddr_is_default')),
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>PubFunc::ddConfig('is_del'))
        );
        $this->setVariable('tableCName','收货地址');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doedituseraddress");
        $this->displayEdit();
    }

    function doEditUserAddress()
    {
        if(!empty($_POST['useraddr_best_date']))
        {
            $_POST['useraddr_best_date'] = strtotime($_POST['useraddr_best_date']);
        }
        $rs = $this->useraddressLogic->update($_POST);
        echo json_encode($rs);exit;
    }
    //收货地址结束

}