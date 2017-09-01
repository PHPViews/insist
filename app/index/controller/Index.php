<?php
namespace app\index\controller;

use app\common\controller\Home;
use think\Loader;

class Index extends Home
{
    public function index()
    {
//        if(request()->isPost()){
//
//        }
        $a=xcode('1111');
        return view();
    }

    public function getVerify()
    {
        $GtSdk = new \GeetestLib(config('Geetest_id'),config('Geetest_key'));
        session_start();
        $data =array(
            "user_id"=>"gtt",
            'client_type'=>'web',
            "ip_address" => "127.0.0.1"
        );
        $status = $GtSdk->pre_process($data);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $data['user_id'];
        echo $GtSdk->get_response_str();
    }
}
