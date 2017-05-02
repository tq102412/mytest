<?php
namespace Adminc\Controller;
use Think\Controller;

class AdminsController extends BaseController{

    public function index(){
        
        $m = M('AdminBase');

        $count = $m->count();

        $Page = getPage($count);
        $show = $Page->show();

        $list = $m->limit($Page->firstRow,$Page->listRows)->select();
        
        $this->assign('list',$list);
        $this->assign('page',$show);

        $this->display();
    }

    public function add(){

        $this->display('edit');
    }

    public function edit(){

        $this->display();
    }

    public function del(){


    }

    public function set(){


    }




}