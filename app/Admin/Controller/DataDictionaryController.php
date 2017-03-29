<?php
namespace App\Admin\Controller;
use App\Logic\DataDictionaryLogic;
use App\Logic\DataDictionaryTypeLogic;
use Core\BaseController;
use Core\PubFunc;
class DataDictionaryController extends BaseController
{
    private $dataDictionaryLogic;
    function __construct()
    {
        parent::__construct();
        $this->dataDictionaryLogic = new DataDictionaryLogic();
    }

    function toDataDictionaryList(){
        $needFieldsResult = $this->dataDictionaryLogic->getNeedFields(array('id','datadictionarytype_name','value','value_desc','ddmark','sort','is_del'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }
        $titleNames[0]='序号';
        $tableTitleButtons = array(
            '添加'=>HTTP_DOMAIN.'/admin_toadddatadic/last_url/'.trim(PATH,'/')
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toeditdatadic/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'eq_id'=>array('type'=>'text','name'=>'序号'),
            'like_value_desc'=>array('type'=>'text','name'=>'值说明')
        );
        $this->setVariable('tableCName','数据字典');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pagedatadiclist");
        $this->displayList();
    }

    function toAddDataDictionary(){
        $dataDictionaryTypeLogic = new DataDictionaryTypeLogic();
        $dataDictionaryTypeResult = $dataDictionaryTypeLogic->getAllDataDictionaryType();
        if($dataDictionaryTypeResult['status']==2&&empty($dataDictionaryTypeResult['result']))
        {
            $this->toTip('缺少数据字典类型');exit;
        }
        $dataDictionaryType = $dataDictionaryTypeResult['result'];
        $needFieldsResult = $this->dataDictionaryLogic->getNeedFields(array('datadictionarytype_id','value_desc','ddmark','sort'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $list = array();
        foreach ($dataDictionaryType as $ddtKey => $ddtVal)
        {
            $list[$ddtVal['ddtype_no']]=$ddtVal['name'];
        }
        $addFields = array(
            'datadictionarytype_id'=>array('cn_name'=>$needFields['datadictionarytype_id'],'type'=>'select','list'=>$list),
            'value_desc'=>array('cn_name'=>$needFields['value_desc'],'type'=>'text'),
            'ddmark'=>array('cn_name'=>$needFields['ddmark'],'type'=>'text'),
            'sort'=>array('cn_name'=>$needFields['sort'],'type'=>'text')
        );

        $this->setVariable('tableCName','数据字典');
        $this->setVariable('addFields',$addFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doadddatadic");
        $this->displayAdd();
    }

    function toEditDataDictionary(){

        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->dataDictionaryLogic->getById($id);
        $dataDictionaryTypeLogic = new DataDictionaryTypeLogic();
        $dataDictionaryTypeResult = $dataDictionaryTypeLogic->getAllDataDictionaryType();
        if($dataDictionaryTypeResult['status']==2&&empty($dataDictionaryTypeResult['result']))
        {
            $this->toTip('缺少数据字典类型');exit;
        }
        $dataDictionaryType = $dataDictionaryTypeResult['result'];
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        $dataConfig = PubFunc::config('data_dictionary');

        $needFieldsResult = $this->dataDictionaryLogic->getNeedFields(array('value_desc','sort','ddmark','is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $list = array();

        foreach ($dataDictionaryType as $ddtKey => $ddtVal)
        {
            $list[$ddtVal['id']]=$ddtVal['name'];
        }
        $editFields = array(
            'value_desc'=>array('cn_name'=>$needFields['value_desc'],'type'=>'text'),
            'sort'=>array('cn_name'=>$needFields['sort'],'type'=>'text'),
            'ddmark'=>array('cn_name'=>$needFields['ddmark'],'type'=>'text'),
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>$dataConfig['is_del']),
        );
        $this->setVariable('tableCName','数据字典');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditdatadic");
        $this->displayEdit();
    }

    function pageDataDictionaryList()
    {
        $rs = $this->dataDictionaryLogic->pageDataDictionaryList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddDataDictionary()
    {
        $dataDictionaryTypeID = !empty($_POST['datadictionarytype_id'])?$_POST['datadictionarytype_id']:0;
        if(empty($dataDictionaryTypeID))
        {
            echo json_encode(PubFunc::returnArray(2,false,'缺少类型id'));exit;
        }
        $dataDictionaryTypeLogic = new DataDictionaryTypeLogic();
        $dataDictionaryTypeResult = $dataDictionaryTypeLogic->getByTypeNo($dataDictionaryTypeID);
        if($dataDictionaryTypeResult['status']==2&&empty($dataDictionaryTypeResult['result']))
        {
            echo json_encode(PubFunc::returnArray(2,false,'查询类型失败'));exit;
        }
        $name = $dataDictionaryTypeResult['result']['name'];
        $_POST['datadictionarytype_name']=$name;
        $rs = $this->dataDictionaryLogic->insertFromTestData($_POST);
        echo json_encode($rs);exit;
    }

    function doEditDataDictionary()
    {
        $rs = $this->dataDictionaryLogic->update($_POST);
        echo json_encode($rs);exit;
    }
}