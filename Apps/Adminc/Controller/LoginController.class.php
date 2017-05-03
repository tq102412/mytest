<?php
namespace Adminc\Controller;
use Think\Controller;

class LoginController extends Controller{

    public function index(){

        $this->display();
    }


    public function verify(){

        $verifyService = D('Verify','Service');

        $verifyService->create();
    }


    public function login(){
        
        $admin = I('post.admin');
        $password = I('post.password');
        $passcode = I('post.passcode');

        if(empty($admin)) $this->ajaxReturn(return_array('用户名不能为空！'));
        if(empty($password)) $this->ajaxReturn(return_array('密码不能为空！'));
        if(empty($passcode)) $this->ajaxReturn(return_array('验证码不能为空！'));

        $verifyService = D('Verify','Service');

        if(!$verifyService->check_verify($passcode)) $this->ajaxReturn(return_array('验证码错误！'));

        $where = array(
            'name' => $admin,
            'pwd' => get_md5($password),
        );

        $m = M('AdminBase');
        $ret = $m->where($where)->find();

        if(empty($ret)){
            $this->ajaxReturn(return_array('用户名或者密码错误！'));
        }


        session('admin_id',$ret['id']);
        session('admin_name',$ret['nickname']);

       
        $this->ajaxReturn(return_array('登陆成功！',1,0,U('Index/index')));

    }

    public function logout(){

        session('admin_id',null);
        session('admin_name',null);
        $this->redirect('index.html');
    }

}