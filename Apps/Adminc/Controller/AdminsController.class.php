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

        if(IS_AJAX){
            $pwd = I('post.pwd');
            if(empty($pwd)) $this->ajaxReturn(return_array('密码不能为空！'));

            $m = D('AdminBase');
            if( !$m->create() ){
                $this->ajaxReturn( return_array( $m->getError() ) );
            }else{
                $ret = $m->add();
                if($ret !== false)
                    $this->ajaxReturn(return_array('添加用户信息成功！',0,1,U('index')));
                else
                    $this->ajaxReturn( return_array('添加用户信息失败！') );
            }
        }


        $this->display('edit');
    }

    public function edit(){

        if(IS_AJAX){

            $m = D('AdminBase');
            
            if( !$m->create() ){
                $this->ajaxReturn( return_array( $m->getError() ) );
            }else{
              
               $ret = $m->save();
               
                if($ret !== false)
                    $this->ajaxReturn(return_array('修改用户信息成功！',0,1,U('index')));
                else
                    $this->ajaxReturn( return_array('修改用户信息失败！') );
            }
           
        }


        $id = I('id',0,'intval');
        $m = M('AdminBase');
        $data = $m->where('id = %d',$id)->find();

        $this->assign('data',$data);
        $this->display();
    }

    public function del(){
        $id = I('post.id');

        if(empty($id)){
            $this->ajaxReturn(return_array('请选择您要删除的信息'));
        }
        $id = json_decode(htmlspecialchars_decode($id),true);
       
        $m = M('AdminBase');

        if(is_array($id))
            $result = $m->where(array('Id'=>array('in',$id)))->delete();
        else
            $result = $m->where(array('Id'=>$id))->delete();

        if($result === false)
            $this->ajaxReturn(return_array('删除失败'));
        else
            $this->ajaxReturn(return_array('删除成功！'.$m->getLastSql(),0,1,0));

    }

   




}