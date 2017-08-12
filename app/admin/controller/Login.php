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
        if(request()->isPost()){
            $username=input('username','','trim');
            $password=input('password','','trim');
            $remember=input('remember');
            // 极验证二次验证
            $GtSdk = new \GeetestLib(config('Geetest_id'),config('Geetest_key'));
            $dt =array(
                "user_id"=>$_SESSION['user_id'],
                "client_type"=>"web",
                "ip_address" => "127.0.0.1"
            );
            if($_SESSION['gtserver'] ==1){ //服务器正常
                $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $dt);
            }else{
                $result = $GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode']);
            }
            if(!$result){
                return json(array('status'=>false,'info'=>'验证码错误！'));
            }
            if($username==""||$password==""){
                return json(array('status'=>false,'info'=>'用户名或密码不能为空！'));
            }
            $info=db('admin')->where(array('username'=>$username,'password'=>strongmd5($password),'status'=>1))->find();
            if($info){
                session(array('expire'=>'604800'));
                session('admin_id',$info['id']);
                $data['last_ip']=request()->ip();
                $data['last_time']=time();
                if($remember == '1'){
                    cookie('admin_id', $info['id'], 604800);
                }
                model('Log')->log($info['username'].'在'.date('Y-m-d H:i:s').'登录了后台','admin',$info['id']);
                db('Admin')->where("id={$info['id']}")->update($data);
                return json(array('status'=>true,'info'=>'登录成功','url'=>url('/admin/Index')));
            }else{
                return json(array('status'=>false,'info'=>'用户名或密码错误！'));
            }
        }else{
            return view();
        }
    }

    public function logout()
    {
        $str= 123456;
        echo sha1(md5($str).config('user_auth_key'));
    }
}