<?php
return array(
    'admin_tolistgoods'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'商品管理',
        'parent_privilege_name'=>'商品中心',
        'privilege_type'=>1,
        'call' => 'Admin/Goods/toGoodsList'
    ),
    'admin_pagegoodslist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页商品列表',
        'parent_privilege_name'=>'商品管理',
        'privilege_type'=>4,
        'call' => 'Admin/Goods/pageGoodsList'
    ),
    'admin_toaddgoods'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到添加商品页面',
        'parent_privilege_name'=>'商品管理',
        'privilege_type'=>2,
        'call' => 'Admin/Goods/toAddGoods'
    ),
    'admin_doaddgoods'=>array(
        'method' => 'GET',
        'rank_num'=>4,
        'privilege_name'=>'添加商品动作',
        'parent_privilege_name'=>'跳转到添加商品页面',
        'privilege_type'=>2,
        'call' => 'Admin/Goods/doAddGoods'
    ),
    'admin_toeditgoods'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑商品页面',
        'parent_privilege_name'=>'商品管理',
        'privilege_type'=>3,
        'call' => 'Admin/Goods/toEditGoods'
    ),
    'admin_doeditgoods'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑商品动作',
        'parent_privilege_name'=>'跳转到编辑商品页面',
        'privilege_type'=>2,
        'call' => 'Admin/Goods/doEditGoods'
    )
);