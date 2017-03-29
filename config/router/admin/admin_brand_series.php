<?php
return array(
    'admin_tolistbrandser'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'商品品牌系列管理',
        'parent_privilege_name'=>'商品中心',
        'privilege_type'=>1,
        'call' => 'Admin/BrandSeries/toBrandSeriesList'
    ),
    'admin_pagebrandserlist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页商品品牌系列列表',
        'parent_privilege_name'=>'商品品牌系列管理',
        'privilege_type'=>4,
        'call' => 'Admin/BrandSeries/pageBrandSeriesList'
    ),
    'admin_toaddbrandser'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到添加商品品牌系列页面',
        'parent_privilege_name'=>'商品品牌系列管理',
        'privilege_type'=>2,
        'call' => 'Admin/BrandSeries/toAddBrandSeries'
    ),
    'admin_doaddbrandser'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'添加商品品牌系列动作',
        'parent_privilege_name'=>'跳转到添加商品品牌系列页面',
        'privilege_type'=>2,
        'call' => 'Admin/BrandSeries/doAddBrandSeries'
    ),
    'admin_toeditbrandser'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑商品品牌系列页面',
        'parent_privilege_name'=>'商品品牌系列管理',
        'privilege_type'=>3,
        'call' => 'Admin/BrandSeries/toEditBrandSeries'
    ),
    'admin_doeditbrandser'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑商品品牌系列动作',
        'parent_privilege_name'=>'跳转到编辑商品品牌系列页面',
        'privilege_type'=>2,
        'call' => 'Admin/BrandSeries/doEditBrandSeries'
    ),
    'admin_dogetbrandserbybrandid'=>array(
        'method' => 'GET',
        'rank_num'=>4,
        'privilege_name'=>'查询品牌下属商品品牌系列动作',
        'parent_privilege_name'=>'跳转到添加商品品牌系列页面',
        'privilege_type'=>4,
        'call' => 'Admin/BrandSeries/doGetBrandSerByBrandID'
    )
);