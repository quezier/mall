<?php
return array(
    'admin_tolistrole'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'角色管理',
        'parent_privilege_name'=>'系统管理',
        'privilege_type'=>1,
        'call' => 'Admin/Role/toRoleList'
    ),
    'admin_pagerolelist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页角色列表',
        'parent_privilege_name'=>'角色管理',
        'privilege_type'=>4,
        'call' => 'Admin/Role/pageRoleList'
    ),
    'admin_toaddrole'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到添加角色页面',
        'parent_privilege_name'=>'角色管理',
        'privilege_type'=>2,
        'call' => 'Admin/Role/toAddRole'
    ),
    'admin_doaddrole'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'添加角色动作',
        'parent_privilege_name'=>'跳转到添加角色页面',
        'privilege_type'=>2,
        'call' => 'Admin/Role/doAddRole'
    ),
    'admin_toeditrole'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑角色页面',
        'parent_privilege_name'=>'角色管理',
        'privilege_type'=>3,
        'call' => 'Admin/Role/toEditRole'
    ),
    'admin_doeditrole'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑角色动作',
        'parent_privilege_name'=>'跳转到编辑角色页面',
        'privilege_type'=>2,
        'call' => 'Admin/Role/doEditRole'
    )
);