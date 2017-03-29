<?php
return array(
    'admin_tolistsystemcon'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'系统配置管理',
        'parent_privilege_name'=>'系统管理',
        'privilege_type'=>1,
        'call' => 'Admin/SystemConfig/toSystemConfigList'
    ),
    'admin_pagesystemconlist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页系统配置列表',
        'parent_privilege_name'=>'系统配置管理',
        'privilege_type'=>4,
        'call' => 'Admin/SystemConfig/pageSystemConfigList'
    ),

    'admin_toeditsystemcon'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑系统配置页面',
        'parent_privilege_name'=>'系统配置管理',
        'privilege_type'=>3,
        'call' => 'Admin/SystemConfig/toEditSystemConfig'
    ),
    'admin_doeditsystemcon'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑系统配置动作',
        'parent_privilege_name'=>'跳转到编辑系统配置页面',
        'privilege_type'=>2,
        'call' => 'Admin/SystemConfig/doEditSystemConfig'
    )
);