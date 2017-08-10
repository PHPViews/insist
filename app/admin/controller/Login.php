<?php
/**
 * User: Insist
 * Date: 2017/8/10
 * Time: 19:19
 */
namespace app\admin\controller;

use app\common\controller\Admin;

class Login extends Admin{

    public function _initialize()
    {
        $action = request()->action();
        $admin_id = input('session.admin_id',0);
        if($admin_id && $action!='logout'){
            $this->redirect('/admin/Index');
        }
    }

    public function index()
    {
        return view();
    }

    public function logout()
    {
        return "logout";
    }

    public function getVerify()
    {
        return "aa";
    }
}