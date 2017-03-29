<?php
return array(
    'admin_tolistdatadic'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'数据字典管理',
        'parent_privilege_name'=>'系统管理',
        'privilege_type'=>1,
        'call' => 'Admin/DataDictionary/toDataDictionaryList'
    ),
    'admin_pagedatadiclist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页数据字典列表',
        'parent_privilege_name'=>'数据字典管理',
        'privilege_type'=>4,
        'call' => 'Admin/DataDictionary/pageDataDictionaryList'
    ),
    'admin_toadddatadic'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到添加数据字典页面',
        'parent_privilege_name'=>'数据字典管理',
        'privilege_type'=>2,
        'call' => 'Admin/DataDictionary/toAddDataDictionary'
    ),
    'admin_doadddatadic'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'添加数据字典动作',
        'parent_privilege_name'=>'跳转到添加数据字典页面',
        'privilege_type'=>2,
        'call' => 'Admin/DataDictionary/doAddDataDictionary'
    ),
    'admin_toeditdatadic'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑数据字典页面',
        'parent_privilege_name'=>'数据字典管理',
        'privilege_type'=>3,
        'call' => 'Admin/DataDictionary/toEditDataDictionary'
    ),
    'admin_doeditdatadic'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑数据字典动作',
        'parent_privilege_name'=>'跳转到编辑数据字典页面',
        'privilege_type'=>2,
        'call' => 'Admin/DataDictionary/doEditDataDictionary'
    )
);