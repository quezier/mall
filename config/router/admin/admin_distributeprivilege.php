<?php
return array(
    
    'admin_todistprivilege'=>array(
        'method'=>'GET',
        'rank_num'=>2,
        'privilege_name'=>'分配权限',
        'parent_privilege_name'=>'系统管理',
        'privilege_type'=>1,
        'call'=>'Admin/DistributePrivilege/toDistributePrivilege'
    ),
    'admin_getprivilege'=>array(
        'method'=>'GET',
        'rank_num'=>3,
        'privilege_name'=>'根据角色获取权限',
        'parent_privilege_name'=>'分配权限',
        'privilege_type'=>3,
        'call'=>'Admin/DistributePrivilege/getPrivilege'
    ),
    'admin_dodisprivilege'=>array(
        'method'=>'GET',
        'rank_num'=>3,
        'privilege_name'=>'分配权限动作',
        'parent_privilege_name'=>'分配权限',
        'privilege_type'=>3,
        'call'=>'Admin/DistributePrivilege/doDistributePrivilege'
    )

);
