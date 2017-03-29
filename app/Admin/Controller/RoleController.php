<?php
namespace App\Admin\Controller;
use App\Logic\RoleLogic;
use Core\BaseController;
use Core\PubFunc;
class RoleController extends BaseController
{
    private $roleLogic;
    function __construct()
    {
        parent::__construct();
        $this->roleLogic = new RoleLogic();
    }

    function toRoleList(){
        $needFieldsResult = $this->roleLogic->getNeedFields(array('role_name','add_date','is_del'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }
        $tableTitleButtons = array(
            '添加'=>HTTP_DOMAIN.'/admin_toaddrole/last_url/'.trim(PATH,'/')
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toeditrole/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'like_role_name'=>array('type'=>'text','name'=>'角色名称')
        );
        $this->setVariable('tableCName','角色');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pagerolelist");
        $this->displayList();
    }

    function toAddRole(){
        $needFieldsResult = $this->roleLogic->getNeedFields(array('role_name'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $addFields = array(
            'role_name'=>array('cn_name'=>$needFields['role_name'],'type'=>'text')
        );

        $this->setVariable('tableCName','角色');
        $this->setVariable('addFields',$addFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doaddrole");
        $this->displayAdd();
    }

    function toEditRole(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->roleLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        $dataConfig = PubFunc::config('data_dictionary');

        $needFieldsResult = $this->roleLogic->getNeedFields(array('role_name','is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $dataConfig = PubFunc::config('data_dictionary');
        $typeData = $dataConfig['is_del'];
        $editFields = array(
            'role_name'=>array('cn_name'=>$needFields['role_name'],'type'=>'text'),
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>$typeData)
        );
        $this->setVariable('tableCName','角色');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditrole");
        $this->displayEdit();
    }

    function pageRoleList()
    {
        $rs = $this->roleLogic->pageRoleList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddRole()
    {
        $rs = $this->roleLogic->insertFromTestData($_POST);
        echo json_encode($rs);exit;
    }

    function doEditRole()
    {
        $_POST['edit_date']=time();
        $admin=PubFunc::adminInfo();
        $_POST['edit_id']=$admin['admin_id'];
        $rs = $this->roleLogic->update($_POST);
        echo json_encode($rs);exit;
    }
}