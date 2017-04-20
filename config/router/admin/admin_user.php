<?php
return array(
    'admin_tolistuser'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'用户列表',
        'parent_privilege_name'=>'用户管理',
        'privilege_type'=>1,
        'call' => 'Admin/User/toUserList'
    ),
    'admin_pageuserlist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页用户列表',
        'parent_privilege_name'=>'用户列表',
        'privilege_type'=>4,
        'call' => 'Admin/User/pageUserList'
    ),
    'admin_toedituser'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑用户页面',
        'parent_privilege_name'=>'用户列表',
        'privilege_type'=>3,
        'call' => 'Admin/User/toEditUser'
    ),
    'admin_doedituser'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑用户动作',
        'parent_privilege_name'=>'跳转到编辑用户页面',
        'privilege_type'=>2,
        'call' => 'Admin/User/doEditUser'
    ),

    'admin_tolistuseraddress'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'收货地址列表',
        'parent_privilege_name'=>'用户管理',
        'privilege_type'=>1,
        'call' => 'Admin/User/toUserAddressList'
    ),
    'admin_pageuseraddresslist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页收货地址列表',
        'parent_privilege_name'=>'收货地址列表',
        'privilege_type'=>4,
        'call' => 'Admin/User/pageUserAddressList'
    ),
    'admin_toedituseraddress'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑收货地址页面',
        'parent_privilege_name'=>'收货地址列表',
        'privilege_type'=>3,
        'call' => 'Admin/User/toEditUserAddress'
    ),
    'admin_doedituseraddress'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑收货地址动作',
        'parent_privilege_name'=>'跳转到编辑收货地址页面',
        'privilege_type'=>2,
        'call' => 'Admin/User/doEditUserAddress'
    ),


);