<?php


namespace App\Admin\Controller;


use App\Logic\PrivilegeLogic;
use Core\BaseController;
use App\Logic\RoleLogic;
use App\Logic\DistributePrivilegeLogic;
class DistributePrivilegeController extends BaseController
{
    private $roleLogic;
    private $distributePrivilegeLogic;
    function __construct()
    {
        parent::__construct();
        $this->roleLogic = new RoleLogic();
        $this->distributePrivilegeLogic = new DistributePrivilegeLogic();
    }

    function toDistributePrivilege() {

        $getResult = $this->roleLogic->getAllRole();
        $roles = null;
        if($getResult['status']==1&&!empty($getResult['result'])) {

            $roles = $getResult['result'];
        }

        unset($this->roleLogic);
        $this->setVariable('roles', $roles);
        $this->display();
    }

    function doDistributePrivilege()
    {
        $privileges = $_GET['privileges'];
        $role_id = $_GET['role_id'];
        $rs = $this->distributePrivilegeLogic->doDistributePrivilege($privileges,$role_id);
        echo json_encode($rs);exit;
    }

    function getPrivilege()
    {
        $id = !empty($_GET['id'])?intval($_GET['id']):0;
        $role_id=!empty($_GET['role_id'])?intval($_GET['role_id']):0;
        $privilegeLogic = new PrivilegeLogic();
        $getResult = $privilegeLogic->getPrivilege($id,$role_id);

        echo json_encode($getResult);

    }
    
}