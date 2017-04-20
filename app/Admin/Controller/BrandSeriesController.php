<?php
namespace App\Admin\Controller;
use App\Logic\BrandLogic;
use App\Logic\BrandSeriesLogic;
use Core\BaseController;
use Core\PubFunc;
class BrandSeriesController extends BaseController
{
    private $brandSeriesLogic;
    function __construct()
    {
        parent::__construct();
        $this->brandSeriesLogic = new BrandSeriesLogic();
    }

    function doGetBrandSerByBrandID()
    {
        $bid = !empty($_GET['brand_id'])?intval($_GET['brand_id']):0;
        $rs = $this->brandSeriesLogic->getByBrandID($bid);
        echo json_encode($rs);exit;
    }
    function toBrandSeriesList(){
        $needFieldsResult = $this->brandSeriesLogic->getNeedFields(array('id','brandser_name','brandser_pinyin','brandser_en','brand_id','brandser_add_date','is_del'));

        if($needFieldsResult['status']==1)
        {
            $titleNames = array_values($needFieldsResult['result']);
            $displayFields = array_keys($needFieldsResult['result']);
        }
        else{
            return $needFieldsResult;
        }

        $tableTitleButtons = array(
            '添加'=>HTTP_DOMAIN.'/admin_toaddbrandser/last_url/'.trim(PATH,'/')
        );
        $dropDownMenus = array(
            '编辑'=>HTTP_DOMAIN.'/admin_toeditbrandser/id/{{v.id}}/last_url/'.trim(PATH,'/')
        );
        $searchInputs = array(
            'eq_id'=>array('type'=>'text','name'=>'序号')
        );
        $this->setVariable('tableCName','商品品牌系列');
        $this->setVariable('titleNames',$titleNames);
        $this->setVariable('displayFields',$displayFields);
        $this->setVariable('dropDownMenus',$dropDownMenus);
        $this->setVariable('tableTitleButtons',$tableTitleButtons);
        $this->setVariable('searchInputs',$searchInputs);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_pagebrandserlist");
        $this->displayList();
    }

    function toAddBrandSeries(){
        $needFieldsResult = $this->brandSeriesLogic->getNeedFields(array('brand_id','brandser_name','brandser_pinyin','brandser_en','brandser_detail'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $brandlogic=new BrandLogic();
        $brandlist=$brandlogic->getAllBrand();
        $listbrand = PubFunc::getSelectData($brandlist['result'],'brand_name');;
        $needFields = $needFieldsResult['result'];
        $addFields = array(
            'brand_id'=>array('cn_name'=>$needFields['brand_id'],'type'=>'select','list'=>$listbrand),
            'brandser_name'=>array('cn_name'=>$needFields['brandser_name'],'type'=>'text'),
            'brandser_pinyin'=>array('cn_name'=>$needFields['brandser_pinyin'],'type'=>'text'),
            'brandser_en'=>array('cn_name'=>$needFields['brandser_en'],'type'=>'text'),
            'brandser_detail'=>array('cn_name'=>$needFields['brandser_detail'],'type'=>'editor','is_one_row'=>1),
        );

        $this->setVariable('tableCName','商品品牌系列');
        $this->setVariable('addFields',$addFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doaddbrandser");
        $this->displayAdd();
    }

    function toEditBrandSeries(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->brandSeriesLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }
        $isDel = PubFunc::ddConfig('is_del');

        $needFieldsResult = $this->brandSeriesLogic->getNeedFields(array('brand_id','brandser_name','brandser_pinyin','brandser_en','brandser_detail'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $brandlogic=new BrandLogic();
        $brandlist=$brandlogic->getAllBrand();
        $listbrand = PubFunc::getSelectData($brandlist['result'],'brand_name');;
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'brand_id'=>array('cn_name'=>$needFields['brand_id'],'type'=>'select','list'=>$listbrand),
            'brandser_name'=>array('cn_name'=>$needFields['brandser_name'],'type'=>'text'),
            'brandser_pinyin'=>array('cn_name'=>$needFields['brandser_pinyin'],'type'=>'text'),
            'brandser_en'=>array('cn_name'=>$needFields['brandser_en'],'type'=>'text'),
            'brandser_detail'=>array('cn_name'=>$needFields['brandser_detail'],'type'=>'editor','is_one_row'=>1),
        );
        $this->setVariable('tableCName','商品品牌系列');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditbrandser");
        $this->displayEdit();
    }

    function pageBrandSeriesList()
    {
        $rs = $this->brandSeriesLogic->pageBrandSeriesList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddBrandSeries()
    {
        if(!empty($_POST['brandser_detail']))
        {
            $_POST['brandser_detail'] = htmlentities($_POST['brandser_detail']);
        }
        $_POST['brand_add_date']=time();
        $rs = $this->brandSeriesLogic->insertFromTestData($_POST);
        echo json_encode($rs);exit;
    }

    function doEditBrandSeries()
    {
        if(!empty($_POST['brandser_detail']))
        {
            $_POST['brandser_detail'] = htmlentities($_POST['brandser_detail']);
        }
        $_POST['brandser_add_date']=time();
        $rs = $this->brandSeriesLogic->update($_POST);
        echo json_encode($rs);exit;
    }
}