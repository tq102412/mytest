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

}