<?php
return array(
    'admin_tolistdatadictyp'=>array(
        'method' => 'GET',
        'rank_num'=>2,
        'privilege_name'=>'数据字典类型管理',
        'parent_privilege_name'=>'系统管理',
        'privilege_type'=>1,
        'call' => 'Admin/DataDictionaryType/toDataDictionaryTypeList'
    ),
    'admin_pagedatadictyplist'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'查询分页数据字典类型列表',
        'parent_privilege_name'=>'数据字典类型管理',
        'privilege_type'=>4,
        'call' => 'Admin/DataDictionaryType/pageDataDictionaryTypeList'
    ),
    'admin_toadddatadictyp'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到添加数据字典类型页面',
        'parent_privilege_name'=>'数据字典类型管理',
        'privilege_type'=>2,
        'call' => 'Admin/DataDictionaryType/toAddDataDictionaryType'
    ),
    'admin_doadddatadictyp'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'添加数据字典类型动作',
        'parent_privilege_name'=>'跳转到添加数据字典类型页面',
        'privilege_type'=>2,
        'call' => 'Admin/DataDictionaryType/doAddDataDictionaryType'
    ),
    'admin_toeditdatadictyp'=>array(
        'method' => 'GET',
        'rank_num'=>3,
        'privilege_name'=>'跳转到编辑数据字典类型页面',
        'parent_privilege_name'=>'数据字典类型管理',
        'privilege_type'=>3,
        'call' => 'Admin/DataDictionaryType/toEditDataDictionaryType'
    ),
    'admin_doeditdatadictyp'=>array(
        'method' => 'POST',
        'rank_num'=>4,
        'privilege_name'=>'编辑数据字典类型动作',
        'parent_privilege_name'=>'跳转到编辑数据字典类型页面',
        'privilege_type'=>2,
        'call' => 'Admin/DataDictionaryType/doEditDataDictionaryType'
    )
);