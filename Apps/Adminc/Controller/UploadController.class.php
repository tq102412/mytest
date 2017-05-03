<?php
namespace Adminc\Controller;
use Think\Controller;

class UploadController extends BaseController{

    public function upload(){
        $up = D('Upload','Service');
        $up->upload();
    }

    public function manager(){
        $up = D('Upload','Service');
        $up->manager();
    }


}