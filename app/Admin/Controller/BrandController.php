<?php
namespace App\Admin\Controller;
use App\Logic\BrandCategoryLogic;
use App\Logic\BrandLogic;
use App\Logic\GoodsCategoryLogic;
use Core\BaseController;
use Core\PubFunc;
use Core\Upload;
use Core\Image;

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
        $needFieldsResult = $this->brandLogic->getNeedFields(array('id','brand_name','brand_pinyin','brand_en','brand_logo','brand_desc','brand_url','brand_add_date','is_del'));

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
            'eq_id'=>array('type'=>'text','name'=>'序号'),
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
        //根据品牌里外键商品分类ID查找商品分类名称
        $gclogic=new GoodsCategoryLogic();
        $topCategory = $gclogic->getTop();
        $this->setVariable('topCategory', $topCategory['result']);

        $option = array(
            'file_count'=>6,
            'single_file_size'=>2*1024*1024,
            'extensions'=>'gif,jpg,jpeg,bmp,png',
            'mime_types'=>'image/gif,image/jpg,image/jpeg,image/png',
            'server'=>HTTP_DOMAIN.'/admin_brandlogodoupload',
        );
        $this->setVariable('option',$option);

        $this->setVariable('tableCName','商品品牌');
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doaddbrand");
        $this->display();
    }

    function toEditBrand(){
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $rs = $this->brandLogic->getById($id);
        if($rs['status']==1&&!empty($rs['result'])&&count($rs['result'])>0)
        {
            $this->setVariable('tableObject',$rs['result']);
        }

        //品牌—分类关系表中，品牌关联的分类ID
        $arrayCateId = [];
        $bclogic=new BrandCategoryLogic();
        $result = $bclogic->getByBrandId($id);
        if (count($result['result']) > 0) {
            foreach ($result['result'] as $k => $v) {
                array_push($arrayCateId, $v['category_id']);
            }
        }
        $cateIdStr = implode(',', $arrayCateId);
        $this->setVariable('cateid', $cateIdStr);

        //根据分类ID，查询分类名称
        $gclogic=new GoodsCategoryLogic();
        $arrayCateName = [];
        foreach ($arrayCateId as $k => $v) {
            $goodscate = $gclogic->getById($v);
            array_push($arrayCateName, $goodscate['result']['goodscate_name']);
        }
        $cateNameStr = implode(',', $arrayCateName);
        $this->setVariable('catename', $cateNameStr);

        //根据品牌里外键商品分类ID查找商品分类名称
        $gclogic=new GoodsCategoryLogic();
        $topCategory = $gclogic->getTop();
        $this->setVariable('topCategory', $topCategory['result']);

        //Logo
        $option = array(
            'file_count'=>6,
            'single_file_size'=>2*1024*1024,
            'bid'=>$id,
            'extensions'=>'gif,jpg,jpeg,bmp,png',
            'mime_types'=>'image/gif,image/jpg,image/jpeg,image/png',
            'server'=>HTTP_DOMAIN.'/admin_brandlogodoupload',
        );
        $this->setVariable('option',$option);

        $isDel = PubFunc::ddConfig('is_del');
        $needFieldsResult = $this->brandLogic->getNeedFields(array('brand_name','brand_pinyin','brand_en','brand_logo','brand_desc','brand_url','brand_add_date','is_del'));
        if($needFieldsResult['status']==2)
        {
            return $needFieldsResult;
        }
        $needFields = $needFieldsResult['result'];
        $editFields = array(
            'brand_name'=>array('cn_name'=>$needFields['brand_name'],'type'=>'text'),
            'brand_pinyin'=>array('cn_name'=>$needFields['brand_pinyin'],'type'=>'text'),
            'brand_en'=>array('cn_name'=>$needFields['brand_en'],'type'=>'text'),
            'brand_logo'=>array('cn_name'=>$needFields['brand_logo'],'type'=>'text'),
            'brand_desc'=>array('cn_name'=>$needFields['brand_desc'],'type'=>'text'),
            'brand_url'=>array('cn_name'=>$needFields['brand_url'],'type'=>'text'),
            'brand_add_date'=>array('cn_name'=>$needFields['brand_add_date'],'type'=>'text'),
            'is_del'=>array('cn_name'=>$needFields['is_del'],'type'=>'radio','list'=>$isDel),
        );
        $this->setVariable('tableCName','商品品牌');
        $this->setVariable('editFields',$editFields);
        $this->setVariable('actionUrl',HTTP_DOMAIN."/admin_doeditbrand");
        $this->display();
    }

    function getByParentId() {
        $parent_id = $_GET['pid'];
        $goodsCategoryLogic = new GoodsCategoryLogic();
        $result = $goodsCategoryLogic->getByParentID($parent_id);
        echo \json_encode($result);
        exit;
    }

    function getBrandByCateId() {
        $cateID = $_GET['cate_id'];
        $brandLogic = new BrandCategoryLogic();
        $brandCateLogic = new BrandCategoryLogic();
        $tmpbrand = [];
        //根据分类ID查找与之相关联的品牌编号
        $cate = $brandCateLogic->getOne(array('category_id'=>$cateID,'is_del'=>1));
        if (count($cate['result']) > 0) {
            foreach ($cate['result'] as $key => $value) {
                //遍历，根据品牌ID查找品牌
                $brands = $brandLogic->getOne(array('id' => $value['brand_id']));
                array_push($tmpbrand, $brands['result']);
            }
        }
        $tmpbrand1['status'] = 1;
        $tmpbrand1['result'] = $tmpbrand;
        $tmpbrand1['msg'] = '';
        echo json_encode($tmpbrand1);
        exit;
    }

    function pageBrandList()
    {
        $rs = $this->brandLogic->pageBrandList($_GET);
        echo json_encode($rs);exit;
    }

    function doAddBrand()
    {
        if($_POST['category_id1']==""){
            echo json_encode(array('status'=>2,'result'=>'','msg'=>'请选择商品分类'));exit;
        }
        $data = $_POST;
        $data['brand_admin_id'] = PubFunc::session('admin_id');
        $data['brand_add_date'] = time();
        $braName = $_POST['brand_name'];
        $brand = $this->brandLogic->getOne('','where is_del=1 and brand_name=:brand_name',array('brand_name'=>$braName));
        if ($brand['result']!=false) {
            $result['status'] = 2;
            $result['result'] = '';
            $result['msg'] = '品牌名称不能重复!';
        } else {
            $result = $this->brandLogic->insertFromTestData($data);
            if ($result['status'] != 2) {
                $cateid = $_POST['category_id1'];
                $tmpCate = explode(',', $cateid);
                $brandcateLogic = new BrandCategoryLogic();
                foreach ($tmpCate as $key => $value) {
                    $bra_cate['category_id'] = $value;
                    $bra_cate['brand_id'] = $result['result'];
                    //添加品牌-分类关联数据
                    $return = $brandcateLogic->insertFromTestData($bra_cate);
                }
            }
        }
        echo json_encode($result);exit;
    }

    function doEditBrand()
    {
        $brandLogic = new BrandLogic();
        $data = $_POST;
        $result = $brandLogic->update($data);
        if ($result['status'] ==1) {
            $cateid = $_POST['category_id1'];
            $oldcateid = $_POST['c_id'] ;

            $id = $_POST['id'];
            $tmpCate = explode(',', $cateid);
            $tmpOldCate = explode(',', $oldcateid);

            //循环遍历，删除两数据中相同的元素（相同=>不需改动）
            //$tmpCate 存在数据库中的项目id集合；$tmpOldCate 页面选中的项目id集合
            foreach ($tmpOldCate as $key => $v1) {
                foreach ($tmpCate as $key2 => $v2) {
                    if ($v1 == $v2) {
                        unset($tmpOldCate[$key]); //删除$tmpCate数组同值元素
                        unset($tmpCate[$key2]); //删除$tmpOldCate数组同值元素
                    }
                }
            }
            $brandcateLogic = new BrandCategoryLogic();

            //删除相同元素后，$tmpCate 页面选中的项目id集合中所剩元素即为需要做添加的
            if (count($tmpCate) > 0) {
                foreach ($tmpCate as $k => $v) {
                    //添加
                    $bra_cate['category_id'] = $v;
                    $bra_cate['brand_id'] = $id;
                    $return = $brandcateLogic->insertFromTestData($bra_cate);
                }
            }
            //删除相同元素后，$tmpOldCate 存在数据库中的项目id集合中所剩元素即为需要做删除的
            if (count($tmpOldCate) > 0) {
                foreach ($tmpOldCate as $k => $v) {
                    //删除
                    $b_c = $brandcateLogic->getOne('',' where is_del=1 and brand_id=:brand_id and category_id=:category_id ',array('brand_id' => $id, 'category_id' => $v));
                    $bra_cate1['id'] = $b_c['result']['id'];
                    $bra_cate1['is_del'] = 2;
                    $return = $brandcateLogic->update($bra_cate1);
                }
            }
        }
        echo json_encode($result);exit;
    }

    function doBrandThumbUpload()
    {
        if($_POST['is_add']!=1){
            $id = !empty($_POST['bid'])?$_POST['bid']:0;
            if(empty($id))
            {
                echo json_encode(PubFunc::returnArray(2,false,'缺少品牌ID'));exit;
            }
        }
        if(empty($_FILES['file']))
        {
            echo json_encode(PubFunc::returnArray(2,false,'没有上传文件'));exit;
        }
        $upload = new Upload(PubFunc::sysConfig('upload_type_config'));
        $uploadResult = $upload->uploadOne($_FILES['file']);
        if(!empty($uploadResult))
        {
            $savePath = trim($uploadResult['savepath'],'/');
            $saveName = $uploadResult['savename'];
            $uploadsPath = PubFunc::sysConfig('uploads_path');
            $uploadThumbPath = PubFunc::sysConfig('uploads_thumb_path');
            $oriFilePath = $uploadsPath.$savePath.DIR_SP.$saveName;
            $imageObj = new Image();
            $imageObj->open($oriFilePath);
            $imageObj->thumb(200,200,Image::IMAGE_THUMB_CENTER);
            $uploadThumbPath.=date('Ymd',time()).DIR_SP.'brand_logo';
            if(!file_exists($uploadThumbPath))
            {
                PubFunc::createMultiClassFolder($uploadThumbPath);
            }
            $saveResult = $imageObj->save($uploadThumbPath.DIR_SP.$saveName);
            if(!empty($saveResult)&&is_array($saveResult)&&$saveResult['status']==2)
            {
                echo json_encode($saveResult);exit;
            }
            else{
                $main_thumb=$savePath.DIR_SP.'brand_logo'.DIR_SP.$saveName;
                $data=array('id'=>$id,'brand_logo'=>$main_thumb);
                $addResult = $this->brandLogic->update($data);
                if($addResult['status']==1)
                {
                    echo json_encode(PubFunc::returnArray(1,$main_thumb,'上传成功'));exit;
                }
                else{
                    echo json_encode(PubFunc::returnArray(2,false,'保存失败'));exit;
                }
            }
        }
        else{
            echo json_encode(PubFunc::returnArray(2,false,$upload->getError()));exit;
        }
    }

}