<?php


namespace App\Test\Controller;
use Core\BaseController;
use App\Logic\UserInfoLogic;
use Core\CompileOpcache;
use Core\PubFunc;

class UserInfoTestController extends BaseController
{
    private $userInfoLogic;
    function __construct()
    {
        parent::__construct();
        //$this->userInfoLogic = new UserInfoLogic();
    }

    function index()
    {
        $cp = new CompileOpcache();
        $cp->compile('D:\syypn_projects\syypn\vendor\quezier\ezusephp-core');
//        $rs = $this->userInfoLogic->insertUnion();
//
//        if($rs['status']==1)
//        {
//            $rs = $this->userInfoLogic->selectUnion();
//        }
//        PubFunc::varDump($rs);
    }

    function insert()
    {
        $this->userInfoLogic->insert();
        $rs = $this->userInfoLogic->selectAll();
        PubFunc::varDump($rs);
    }

    
    function page()
    {
        //PubFunc::varDump($this->userInfoLogic->selectAll());
        //$rs = $this->userInfoLogic->count();
        $rs = $this->userInfoLogic->page();
        PubFunc::varDump($rs);
    }
    
    
}