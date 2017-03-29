<?php
return array(
    'admin_tolistgoodscat'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'商品分类管理',
        'parent_privilege_name'=>'商品中心',
        'privilege_type'=>1,
        'call' => 'Admin/GoodsCategory/toGoodsCategoryList'
    ),
    'admin_pagegoodscatlist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页商品分类列表',
        'parent_privilege_name'=>'商品分类管理',
        'privilege_type'=>4,
        'call' => 'Admin/GoodsCategory/pageGoodsCategoryList'
    ),
    'admin_toaddgoodscat'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到添加商品分类页面',
        'parent_privilege_name'=>'商品分类管理',
        'privilege_type'=>2,
        'call' => 'Admin/GoodsCategory/toAddGoodsCategory'
    ),
    'admin_doaddgoodscat'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'添加商品分类动作',
        'parent_privilege_name'=>'跳转到添加商品分类页面',
        'privilege_type'=>2,
        'call' => 'Admin/GoodsCategory/doAddGoodsCategory'
    ),
    'admin_toeditgoodscat'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑商品分类页面',
        'parent_privilege_name'=>'商品分类管理',
        'privilege_type'=>3,
        'call' => 'Admin/GoodsCategory/toEditGoodsCategory'
    ),
    'admin_doeditgoodscat'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑商品分类动作',
        'parent_privilege_name'=>'跳转到编辑商品分类页面',
        'privilege_type'=>2,
        'call' => 'Admin/GoodsCategory/doEditGoodsCategory'
    ),
    'admin_dogetgoodscatbypid'=>array(
        'method' => 'GET',
        'rank_num'=>4,
        'privilege_name'=>'查询下级商品分类动作',
        'parent_privilege_name'=>'跳转到添加商品分类页面',
        'privilege_type'=>4,
        'call' => 'Admin/GoodsCategory/doGetGoodsCateByPid'
    )
);