<?php


namespace App\Logic;

use App\Model\DistributePrivilegeModel;
use Core\PubFunc;

class DistributePrivilegeLogic
{
    private $distributePrivilegeModel;
    function __construct()
    {
        $this->distributePrivilegeModel = new DistributePrivilegeModel();
    }

    /**
     * 根据角色id获取权限
     * @param int $roleId 角色Id
     * @param string $field 查询字段
     * @return array
     */
    function getByRoleId($roleId,$field='*')
    {
        $rs = $this->distributePrivilegeModel->selectAll('','WHERE role_id=:rid AND is_del=1',array('rid'=>$roleId),$field);
        return $rs;
    }

    /**
     * 根据角色id和权限id查询授权信息
     * @param int $roleId 角色id
     * @param int $privilegeId 权限id
     * @param string $field 指定查询字段
     * @return array
     */
    function getByRoleIdAndPrivilegeId($roleId,$privilegeId,$field='*')
    {
        $rs = $this->distributePrivilegeModel->selectOne('','WHERE role_id=:rid AND privilege_id=:pid AND is_del=1',array('rid'=>$roleId,'pid'=>$privilegeId),$field);
        return $rs;
    }

    /**
     * 给角色分配权限
     * @param array $data 添加的数据
     * @return array
     */
    function add($data)
    {
        $rs = $this->distributePrivilegeModel->insert($data);
        return $rs;
    }

    /**
     * 软删除
     * @param int $is_del 1.可用 2.禁用
     * @param int $rid 角色id
     * @param int $pid 权限id
     * @return array
     */
    function updDel($is_del,$rid,$pid)
    {
        $rs = $this->distributePrivilegeModel->update('is_del=:is_del','WHERE role_id=:rid AND privilege_id=:pid',array('is_del'=>$is_del,'rid'=>$rid,'pid'=>$pid));
        return $rs;
    }

    /**
     * 给角色分配权限
     * @param string $privileges 用"_"连接的多个权限id字符串
     * @param int $role_id 角色id
     * @return array
     */
    function doDistributePrivilege($privileges,$role_id)
    {
        //$privileges = I('get.privileges');
        //$role_id = I('get.role_id');
        if (empty($privileges) || empty($role_id)) {

            return PubFunc::returnArray(2, null, '参数不能为空');
        }
        $tmpIDArray = explode('_', $privileges);
        $distributePrivileges = $this->getByRoleId($role_id);
        $distributePrivilegeIds = array();
        if(!empty($distributePrivileges['result'])&&count($distributePrivileges['result'])>0)
        {
            foreach ($distributePrivileges['result'] as $pkey => $pval) {
                array_push($distributePrivilegeIds, $pval['privilege_id']);
            }
        }

        $isChange = false;
        foreach ($tmpIDArray as $key => $val) {
            $addData = array();
            //如果提交的权限不在之前被分配的权限里,那么就说明是新权限
            if (!in_array($val, $distributePrivilegeIds)) {
                $addData = array(
                    'role_id'=>$role_id,
                    'privilege_id'=>$val,
                    'add_date'=>time(),
                    'edit_date'=>0,
                    'add_admin_id'=>0,
                    'edit_admin_id'=>0,
                    'is_del'=>1
                );
                $result = $this->add($addData);
                if ($result['status'] == 2) {
                    return $result;
                }
                $isChange = true;
            }
        }
        foreach ($distributePrivilegeIds as $k => $v) {
            //如果已有的权限不在被分配的权限里,那么就说明是删除
            if (!in_array($v, $tmpIDArray)) {
                $result = $this->updDel(2,$role_id,$v);
                if ($result['status'] == 2) {
                    return $result;
                }
                $isChange = true;
            }
        }
        if ($isChange) {
            return PubFunc::returnArray(1,null,'保存成功');

        } else {
            return PubFunc::returnArray(1,null,'没有任何操作');
        }
    }
}