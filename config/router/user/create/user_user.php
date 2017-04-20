<?php
return array(
    'user_tolistuser'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'用户表管理',
        'parent_privilege_name'=>'',
        'privilege_type'=>1,
        'call' => 'User/User/toUserList'
    ),
    'user_pageuserlist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页用户表列表',
        'parent_privilege_name'=>'用户表管理',
        'privilege_type'=>4,
        'call' => 'User/User/pageUserList'
    ),
    'user_toadduser'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到添加用户表页面',
        'parent_privilege_name'=>'用户表管理',
        'privilege_type'=>2,
        'call' => 'User/User/toAddUser'
    ),
    'user_doadduser'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'添加用户表动作',
        'parent_privilege_name'=>'跳转到添加用户表页面',
        'privilege_type'=>2,
        'call' => 'User/User/doAddUser'
    ),
    'user_toedituser'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑用户表页面',
        'parent_privilege_name'=>'用户表管理',
        'privilege_type'=>3,
        'call' => 'User/User/toEditUser'
    ),
    'user_doedituser'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑用户表动作',
        'parent_privilege_name'=>'跳转到编辑用户表页面',
        'privilege_type'=>2,
        'call' => 'User/User/doEditUser'
    )
);