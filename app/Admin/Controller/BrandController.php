<?php
namespace App\Admin\Controller;
use App\Logic\BrandLogic;
use Core\BaseController;
use Core\PubFunc;
class BrandController extends BaseController
{
    private $brandLogic;
    function __construct()
    {
        parent::__construct();
        $this->brandLogic = new BrandLogic();
    }

    function doGetBandByCateID()
    {
        $cid = !empty($_GET['cate_id'])?intval($_GET['cate_id']):0;
        $rs = $this->brandLogic->getByCateID($cid);
        echo json_encode($rs);exit;
    }
    function toBrandList(){
        $needFieldsResult = $this->brandLogic->getNeedFields(array('id'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }

        $tableTitleButtons = array(
            '添加'=>HTTP_DOMAIN.'/admin_toaddbrand/last_url/'.trim(PATH,'/')
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toeditbrand/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'eq_id'=>array('type'=>'text','name'=>'序号')
        );
        $this->setVariable('tableCName','商品品牌');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pagebrandlist");
        $this->displayList();
    }

    function toAddBrand(){
        $needFieldsResult = $this->brandLogic->getNeedFields(array('id'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $addFields = array(
            'id'=>array('cn_name'=>$needFields['id'],'type'=>'text')
        );

        $this->setVariable('tableCName','商品品牌');
        $this->setVariable('addFields',$addFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doaddbrand");
        $this->displayAdd();
    }

    function toEditBrand(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->brandLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        $isDel = PubFunc::ddConfig('is_del');

        $needFieldsResult = $this->brandLogic->getNeedFields(array('is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>$isDel),
        );
        $this->setVariable('tableCName','商品品牌');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditbrand");
        $this->displayEdit();
    }

    function pageBrandList()
    {
        $rs = $this->brandLogic->pageBrandList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddBrand()
    {
        $rs = $this->brandLogic->insertFromTestData($_POST);
        echo json_encode($rs);exit;
    }

    function doEditBrand()
    {
        $rs = $this->brandLogic->update($_POST);
        echo json_encode($rs);exit;
    }
}