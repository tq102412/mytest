<?php
namespace Adminc\Controller;
use Think\Controller;

class AuthController extends BaseController{

    public function index(){

        
        $list = getRuleList();

        $this->assign('list',$list);
        $this->display();
    }

    public function add(){

       if(IS_AJAX){
          
            $m = D('AuthRule');
            if( !$m->create() ){
                $this->ajaxReturn( return_array( $m->getError() ) );
            }else{
                $ret = $m->add();
                if($ret !== false){

                    clearRuleData();
                    $this->ajaxReturn(return_array('添加权限规则成功！',0,1,U('index')));
                }else{
                    $this->ajaxReturn( return_array('添加权限规则失败！') );
                }
            }
        }

        
        $this->display('edit');
    }

    public function edit(){

        if(IS_AJAX){

            $m = D('AuthRule');
            
            if( !$m->create() ){
                $this->ajaxReturn( return_array( $m->getError() ) );
            }else{
              
                $ret = $m->save();

                if($ret !== false){
                    clearRuleData();
                    $this->ajaxReturn(return_array('修改权限规则成功！',0,1,U('index')));
                }else{
                    $this->ajaxReturn( return_array('修改权限规则失败！') );
                }
            }
           
        }

        $id = I('id',0,'intval');
        if($id <= 0 ) $this->error( '参数错误！' );

        $m = M('AuthRule');
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
      
        $m = M('AuthRule');

        if(is_array($id))
            $result = $m->where(array('id'=>array('in',$id)))->delete();
        else
            $result = $m->where(array('id'=>$id))->delete();

        if($result === false){
            $this->ajaxReturn(return_array('删除失败'));
        }else{
            clearRuleData();
            $this->ajaxReturn(return_array('删除成功！',0,1,1));
        }
            

    }



    
}