<?php
namespace App\Admin\Controller;
use App\Logic\SystemConfigLogic;
use Core\BaseController;
use Core\PubFunc;
class SystemConfigController extends BaseController
{
    private $systemConfigLogic;
    function __construct()
    {
        parent::__construct();
        $this->systemConfigLogic = new SystemConfigLogic();
    }

    function toSystemConfigList(){
        $needFieldsResult = $this->systemConfigLogic->getNeedFields(array('id','config_name','config_value'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }

        $titleNames[0]='序号';
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toeditsystemcon/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'eq_id'=>array('type'=>'text','name'=>'序号'),
            'like_config_name'=>array('type'=>'text','name'=>'名称'),
            'eq_config_value'=>array('type'=>'text','name'=>'值'),
        );
        $this->setVariable('tableCName','系统配置');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
//        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pagesystemconlist");
        $this->displayList();
    }


    function toEditSystemConfig(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->systemConfigLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        $dataConfig = PubFunc::config('data_dictionary');

        $needFieldsResult = $this->systemConfigLogic->getNeedFields(array('config_name','config_value'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'config_name'=>array('cn_name'=>$needFields['config_name'],'type'=>'text'),
            'config_value'=>array('cn_name'=>$needFields['config_value'],'type'=>'text'),
        );
        $this->setVariable('tableCName','系统配置');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditsystemcon");
        $this->displayEdit();

    }

    function pageSystemConfigList()
    {
        //过滤删除
        $_GET['eq_is_del']=1;
        $rs = $this->systemConfigLogic->pageSystemConfigList($_GET);
        echo json_encode($rs);exit;
    }

    function doEditSystemConfig()
    {
        $rs = $this->systemConfigLogic->update($_POST);
        echo json_encode($rs);exit;
    }
}