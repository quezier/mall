<?php
return array(
    'admin_tolistbrand'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'商品品牌管理',
        'parent_privilege_name'=>'商品中心',
        'privilege_type'=>1,
        'call' => 'Admin/Brand/toBrandList'
    ),
    'admin_pagebrandlist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页商品品牌列表',
        'parent_privilege_name'=>'商品品牌管理',
        'privilege_type'=>4,
        'call' => 'Admin/Brand/pageBrandList'
    ),
    'admin_toaddbrand'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到添加商品品牌页面',
        'parent_privilege_name'=>'商品品牌管理',
        'privilege_type'=>2,
        'call' => 'Admin/Brand/toAddBrand'
    ),
    'admin_doaddbrand'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'添加商品品牌动作',
        'parent_privilege_name'=>'跳转到添加商品品牌页面',
        'privilege_type'=>2,
        'call' => 'Admin/Brand/doAddBrand'
    ),
    'admin_toeditbrand'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑商品品牌页面',
        'parent_privilege_name'=>'商品品牌管理',
        'privilege_type'=>3,
        'call' => 'Admin/Brand/toEditBrand'
    ),
    'admin_doeditbrand'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑商品品牌动作',
        'parent_privilege_name'=>'跳转到编辑商品品牌页面',
        'privilege_type'=>2,
        'call' => 'Admin/Brand/doEditBrand'
    ),
    'admin_dogetgoodsbrandbycateid'=>array(
        'method' => 'GET',
        'rank_num'=>4,
        'privilege_name'=>'查询分类所属商品品牌动作',
        'parent_privilege_name'=>'跳转到添加商品品牌页面',
        'privilege_type'=>4,
        'call' => 'Admin/Brand/doGetBandByCateID'
    ),

    'admin_getparentidbrand'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询父级商品所属分类列表',
        'parent_privilege_name'=>'商品品牌管理',
        'privilege_type'=>4,
        'call' => 'Admin/Brand/getByParentId'
    ),
    'admin_getbrandbycatelist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询父级商品下属分类列表',
        'parent_privilege_name'=>'商品品牌管理',
        'privilege_type'=>4,
        'call' => 'Admin/Brand/getBrandByCateId'
    ),
    'admin_brandlogodoupload'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'上传商品主图动作',
        'parent_privilege_name'=>'跳转到编辑商品品牌页面',
        'privilege_type'=>2,
        'call' => 'Admin/Brand/doBrandThumbUpload'
    )
);