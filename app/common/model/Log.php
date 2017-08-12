<?php
/**
 * User: Insist
 * Date: 2017/8/12
 * Time: 10:22
 */
namespace app\common\model;

use think\Model;

class Log extends Model{

    public function log($remark='',$model='',$record_id=''){
        //插入行为日志
        $uid=session('admin_id');
        $data['uid']=$uid?$uid:0;
        $data['action_ip']=request()->ip();
        $data['model']=$model;
        $data['record_id']=$record_id;
        $data['create_time']=time();
        $data['remark']=$remark;
        $this->insert($data);
    }
}