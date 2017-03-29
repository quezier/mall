<?php
namespace App\Admin\Controller;
use App\Logic\DataDictionaryTypeLogic;
use Core\BaseController;
use Core\PubFunc;
class DataDictionaryTypeController extends BaseController
{
    private $dataDictionaryTypeLogic;
    function __construct()
    {
        parent::__construct();
        $this->dataDictionaryTypeLogic = new DataDictionaryTypeLogic();
    }

    function toDataDictionaryTypeList(){
        $needFieldsResult = $this->dataDictionaryTypeLogic->getNeedFields(array('id','name','ddtype_no','sort','is_del'));

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
            '添加'=>HTTP_DOMAIN.'/admin_toadddatadictyp/last_url/'.trim(PATH,'/')
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toeditdatadictyp/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'eq_id'=>array('type'=>'text','name'=>'序号'),
            'like_name'=>array('type'=>'text','name'=>'名称'),
        );
        $this->setVariable('tableCName','数据字典类型');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pagedatadictyplist");
        $this->displayList();
    }

    function toAddDataDictionaryType(){
        $needFieldsResult = $this->dataDictionaryTypeLogic->getNeedFields(array('name','ddtype_no','sort'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $addFields = array(
            'name'=>array('cn_name'=>$needFields['name'],'type'=>'text'),
            'ddtype_no'=>array('cn_name'=>$needFields['ddtype_no'],'type'=>'text'),
            'sort'=>array('cn_name'=>$needFields['sort'],'type'=>'text')
        );

        $this->setVariable('tableCName','数据字典类型');
        $this->setVariable('addFields',$addFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doadddatadictyp");
        $this->displayAdd();
    }

    function toEditDataDictionaryType(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->dataDictionaryTypeLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        $dataConfig = PubFunc::config('data_dictionary');

        $needFieldsResult = $this->dataDictionaryTypeLogic->getNeedFields(array('name','ddtype_no','sort','is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'name'=>array('cn_name'=>$needFields['name'],'type'=>'text'),
            'ddtype_no'=>array('cn_name'=>$needFields['ddtype_no'],'type'=>'text'),
            'sort'=>array('cn_name'=>$needFields['sort'],'type'=>'text'),
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>$dataConfig['is_del']),
        );
        $this->setVariable('tableCName','数据字典类型');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditdatadictyp");
        $this->displayEdit();
    }

    function pageDataDictionaryTypeList()
    {
        $rs = $this->dataDictionaryTypeLogic->pageDataDictionaryTypeList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddDataDictionaryType()
    {
        $ddTypeNo = !empty($_POST['ddtype_no'])?$_POST['ddtype_no']:0;
        $ddtLogic = new DataDictionaryTypeLogic();
        $ddtResult = $ddtLogic->getByTypeNo($ddTypeNo);
        if($ddtResult['status']==1&&!empty($ddtResult['result']))
        {
            echo json_encode(PubFunc::returnArray(2,false,'编号重复'));exit;
        }
        else if($ddtResult['status']==2)
        {
            echo json_encode(PubFunc::returnArray(2,false,'检查编号失败'));exit;
        }
        $rs = $this->dataDictionaryTypeLogic->insertFromTestData($_POST);
        echo json_encode($rs);exit;
    }

    function doEditDataDictionaryType()
    {
        $rs = $this->dataDictionaryTypeLogic->update($_POST);
        echo json_encode($rs);exit;
    }
}