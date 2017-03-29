<?php
return array(
    'admin_tolistgoodsatt'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'商品属性管理',
        'parent_privilege_name'=>'商品中心',
        'privilege_type'=>1,
        'call' => 'Admin/GoodsAttr/toGoodsAttrList'
    ),
    'admin_pagegoodsattlist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页商品属性列表',
        'parent_privilege_name'=>'商品属性管理',
        'privilege_type'=>4,
        'call' => 'Admin/GoodsAttr/pageGoodsAttrList'
    ),
    'admin_toaddgoodsatt'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到添加商品属性页面',
        'parent_privilege_name'=>'商品属性管理',
        'privilege_type'=>2,
        'call' => 'Admin/GoodsAttr/toAddGoodsAttr'
    ),
    'admin_doaddgoodsatt'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'添加商品属性动作',
        'parent_privilege_name'=>'跳转到添加商品属性页面',
        'privilege_type'=>2,
        'call' => 'Admin/GoodsAttr/doAddGoodsAttr'
    ),
    'admin_toeditgoodsatt'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑商品属性页面',
        'parent_privilege_name'=>'商品属性管理',
        'privilege_type'=>3,
        'call' => 'Admin/GoodsAttr/toEditGoodsAttr'
    ),
    'admin_doeditgoodsatt'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑商品属性动作',
        'parent_privilege_name'=>'跳转到编辑商品属性页面',
        'privilege_type'=>2,
        'call' => 'Admin/GoodsAttr/doEditGoodsAttr'
    ),
    'admin_dogetgoodsattbycatid'=>array(
        'method' => 'GET',
        'rank_num'=>4,
        'privilege_name'=>'查询分类下属商品属性动作',
        'parent_privilege_name'=>'跳转到添加商品属性页面',
        'privilege_type'=>4,
        'call' => 'Admin/GoodsAttr/doGetGoodsAttrByCateID'
    )
);