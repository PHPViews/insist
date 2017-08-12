<?php
// 应用公共文件

/**
 * 对字符串进行强加密
 * @param $str
 */
function strongmd5($str){
    return sha1(md5($str).config('user_auth_key'));
}
