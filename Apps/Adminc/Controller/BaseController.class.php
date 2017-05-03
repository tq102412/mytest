<?php
namespace Adminc\Controller;
use Think\Controller;
use Think\Auth;

class BaseController extends Controller{

     public function _initialize(){
        
        $user = session('admin_id');

        if(empty($user)){
            if(IS_AJAX){
                $this->ajaxReturn(return_array('登陆凭证过期，请重新登陆'),1,0,U('Login/index'));
            }else{
                redirect(U('Login/index'));
            }
        }

        $auth = new Auth();
        if(!$auth->check(CONTROLLER_NAME.'/'.ACTION_NAME,$user)){
           // echo CONTROLLER_NAME.'/'.ACTION_NAME;
           // $this->error('你没有权限');
        }
            
            
        $this->set_layout();

    }

    


    private function set_layout(){

        layout('public/_layout');

    }


}