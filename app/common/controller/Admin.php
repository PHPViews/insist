<?php
/**
 * User: Insist
 * Date: 2017/8/10
 * Time: 19:12
 */
namespace app\common\controller;

class Admin extends Common{

    public function _initialize()
    {
        parent::_initialize();
        $admin_id = input('session.admin_id',0);
        if(!$admin_id){
            $this->redirect('/admin/Login/index');
        }
    }
}