<?php
namespace Adminc\Service;

class AuthGroupAccessServer{

    public function index($uid,$group){
        $m = M('auth_group_access');
        $data = $m->where('uid = %d', $uid)->find();
        if(empty($data)){
            $ret = $m->data(array('uid'=>$uid,'group_id',$group))->add();
        }else{
            $ret = $m->where(array('uid'=>$uid))->setField('group_id',$group);
        }

        return $ret;
    }

}