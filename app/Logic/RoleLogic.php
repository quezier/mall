<?php


namespace App\Logic;
use App\Model\RoleModel;
use Core\PubFunc;
class RoleLogic
{
    private $roleModel;
    function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    function getAllRole()
    {
        $rs = $this->roleModel->selectAll('','WHERE is_del=1 AND id<>1');
        unset($this->roleModel);
        return $rs;
    }

    /**根据权限查询权限
     * @param $role_id 当前登陆者权限id
     * @return array
     */
    function getAllRoleBy($role_id)
    {
        switch ($role_id)
        {
            case 1:
                $where='WHERE is_del=1 AND id<>1';
                break;
            case 5:
                $where='WHERE is_del=1 AND id=6 or id=7';
                break;
            case 6:
                $where='WHERE is_del=1 AND id=7 or id=8';
                break;
            case 7:
                $where='WHERE is_del=1 AND id=8 or id=9';
                break;
            default:
                ;
        }
        $rs = $this->roleModel->selectAll('',$where);
        return $rs;
    }

    function getNeedFields($needFields)
    {
        $fields = $this->roleModel->fields;
        $tmpArray = array();
        if(!empty($fields)&&!empty($needFields)&&count($needFields)>0)
        {
            foreach ($needFields as $nfKey => $nfVal)
            {
                if(array_key_exists($nfVal,$fields))
                {
                    $tmpArray[$nfVal] = $fields[$nfVal];
                }
            }
            return PubFunc::returnArray(1,$tmpArray,'获取数组成功');
        }
        else{
            return PubFunc::returnArray(2,false,'缺少参数');
        }
    }

    function pageRoleList($param)
    {
        $p = 1;
        if (!empty($param['p'])) {
            $p = $param['p'];
        }
        unset($param['p']);
        $where = ' WHERE 1=1 ';
        $changeResult = $this->roleModel->getWhereAndParamForPage($param);
        if($changeResult['status']==2)
        {
            return $changeResult;
        }
        $where.= $changeResult['result']['where'];
        $data = $changeResult['result']['param'];
        $where.=" ORDER BY role.id desc";
        $rs = $this->roleModel->page($p, 0, '', $where,$data , $field = '*');
        return $rs;
    }

    /**
     * 插入记录
     * @param array $data
     * @return array
     */
    function insert($data)
    {
        $rs = $this->roleModel->insert($data);
        return $rs;
    }

    /**
     * 与测试数据合并生成插入数据，并插入,因为每个字段不能为空
     * @param array $data 要插入的数据
     * @return array
     */
    function insertFromTestData($data)
    {
        $insertTestData = $this->getInsertData();
        $data = array_merge($insertTestData, $data);
        $rs = $this->insert($data);
        return $rs;
    }

    /**
     * 获取测试插入用的数据
     * @return array
     */
    function getInsertData()
    {
        $rs = $this->roleModel->_testData;
        $adminInfo = PubFunc::adminInfo();
        $rs['user_id']=$adminInfo['admin_id'];
        $rs['add_date']=time();
        $rs['is_del']=1;
        return $rs;
    }

    /**
     * 根据主键id更新数据
     * @param array $data 要更新的数据集
     * @return array
     */
    function update($data)
    {
        $rs = $this->roleModel->updateAuto($data);
        return $rs;
    }

    /**
     * 根据id查询数据
     * @param int $id 主键id
     * @return array
     */
    function getById($id)
    {
        if(empty($id)){return PubFunc::returnArray(2,false,'缺少参数');}
        $rs = $this->roleModel->selectOne('','WHERE id=:id',array('id'=>$id),'*');
        return $rs;
    }
}