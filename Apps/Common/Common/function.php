<?php

/**
 *
 * 获取md5编码后的字符
 * @param  string  $str  需要编码的字符串
 * @return string
 *
 */
function get_md5($str){
    
    if(empty($str))     return '';
    return substr(md5(C('MD5_KEY').$str),3,16);
}


/**
 *
 * 设置一个ajax返回数组
 *
 * @param  string  $msg   设置提示消息
 * @param  string  $box   设置显示类型
 * @param  string  $status  设置状态码
 * @param  string  $url   设置跳转的url
 * @return string
 *
 */
function return_array($msg,$box=1,$status=0,$url=null){

    $array=array(
        "status"=>$status,
        "msg"=>$msg,
        "box" =>$box,
        "url"=>$url
    );
    return $array;
}




/**
 *
 * 验证手机号码格式
 * @param string $mobile 手机号码
 * @return bool
 *
 */

function isMobile($mobile) {
    if (!is_numeric($mobile)) {
        return false;
    }
    if(!preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile)){
        return false;
    }
    return true;
}