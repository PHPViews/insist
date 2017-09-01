<?php
// 应用公共文件
use \extend\QRcode as QRcode;
/**
 * 对字符串进行强加密
 */
function strongmd5($str){
    return sha1(md5($str).config('user_auth_key'));
}
//方法1  从vendor加载
function QRcode($url,$path=false,$level='L',$size=4){
    vendor('phpqrcode.phpqrcode');
    if($path){
        $path = './uploads/qrcode/';
    }else{
        QRcode::png($url,false,$level,$size);
    }
    die();
}

//方法2  从extend加载
function xcode($url,$path=false,$level='L',$size=4){
    if($path){
        return "111";
    }else{
        \QRcode::png($url,$path,$level,$size);
    }
    exit();
}
