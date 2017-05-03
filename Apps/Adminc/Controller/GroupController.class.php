<?php
namespace Adminc\Controller;
use Think\Controller;

class GroupController extends BaseController{

    public function index(){

        $m = M('AuthGroup');
        $list = $m->select();

        $this->assign('list',$list);
        $this->display();
    }

    public function add(){

        if(IS_AJAX){
          
            $m = D('AuthGroup');
            if( !$m->create() ){
                $this->ajaxReturn( return_array( $m->getError() ) );
            }else{
                $ret = $m->add();
                if($ret !== false)
                    $this->ajaxReturn(return_array('添加用户组成功！',0,1,U('index')));
                else
                    $this->ajaxReturn( return_array('添加用户组失败！') );
            }
        }

        $this->display('edit');
    }


    public function edit(){

        if(IS_AJAX){

            $m = D('AuthGroup');
            
            if( !$m->create() ){
                $this->ajaxReturn( return_array( $m->getError() ) );
            }else{
              
               $ret = $m->save();
               
                if($ret !== false)
                    $this->ajaxReturn(return_array('修改用户组成功！',0,1,U('index')));
                else
                    $this->ajaxReturn( return_array('修改用户组失败！') );
            }
           
        }

        $id = I('id',0,'intval');
        if($id <= 0 ) $this->error( '参数错误！' );

        $m = M('AuthGroup');
        $data = $m->where('id = %d',$id)->find();

        $this->assign('data',$data);
        $this->display();

    }


    public function group_access(){
        $list = getRuleList();

        $this->assign('list',$list);
        $this->display();
    }

    


    public function del(){
        $id = I('post.id');

        if(empty($id)){
            $this->ajaxReturn(return_array('请选择您要删除的信息'));
        }
        $id = json_decode(htmlspecialchars_decode($id),true);
      
        $m = M('AuthGroup');

        if(is_array($id))
            $result = $m->where(array('id'=>array('in',$id)))->delete();
        else
            $result = $m->where(array('id'=>$id))->delete();

        if($result === false){
            $this->ajaxReturn(return_array('删除失败'));
        }else{
            $this->ajaxReturn(return_array('删除成功！',0,1,1));
        }
            

    }



    
}