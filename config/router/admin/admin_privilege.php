<?php
return array(
    'admin_tolistprivilege'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'权限管理',
        'parent_privilege_name'=>'系统管理',
        'privilege_type'=>1,
        'call' => 'Admin/Privilege/toPrivilegeList'
    ),
    'admin_pageprivilegelist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页权限列表',
        'parent_privilege_name'=>'权限管理',
        'privilege_type'=>4,
        'call' => 'Admin/Privilege/pagePrivilegeList'
    ),
    'admin_toaddprivilege'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到添加权限页面',
        'parent_privilege_name'=>'权限管理',
        'privilege_type'=>2,
        'call' => 'Admin/Privilege/toAddPrivilege'
    ),
    'admin_doaddprivilege'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'添加权限动作',
        'parent_privilege_name'=>'跳转到添加权限页面',
        'privilege_type'=>2,
        'call' => 'Admin/Privilege/doAddPrivilege'
    ),
    'admin_toeditprivilege'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑权限页面',
        'parent_privilege_name'=>'权限管理',
        'privilege_type'=>3,
        'call' => 'Admin/Privilege/toEditPrivilege'
    ),
    'admin_doeditprivilege'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑权限动作',
        'parent_privilege_name'=>'跳转到编辑权限页面',
        'privilege_type'=>2,
        'call' => 'Admin/Privilege/doEditPrivilege'
    ),
    'admin_doautoaddprivilege'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'自动添加权限动作',
        'parent_privilege_name'=>'权限管理',
        'privilege_type'=>2,
        'call' => 'Admin/Privilege/doAutoAddPrivilege'
    )
);