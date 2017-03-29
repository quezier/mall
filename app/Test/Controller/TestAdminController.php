<?php


namespace App\Test\Controller;
use App\Logic\AdminLogic;
use Core\BaseController;
use App\Logic\UserInfoLogic;
use Core\PubFunc;

class TestAdminController extends BaseController
{
    private $adminLogic;
    function __construct()
    {
        parent::__construct();
        $this->adminLogic = new AdminLogic();
    }

    function insert()
    {
        $this->adminLogic->insertTest();
        $rs = $this->adminLogic->selectAll();
        PubFunc::varDump($rs);
    }

    
    function page()
    {
        //PubFunc::varDump($this->userInfoLogic->selectAll());
        //$rs = $this->userInfoLogic->count();
        $rs = $this->adminLogic->page();
        PubFunc::varDump($rs);
    }
    
    
}