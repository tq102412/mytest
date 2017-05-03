<?php
namespace Adminc\Controller;
use Think\Controller;

class FrameController extends BaseController{

    public function index(){

        $sdate = I('sdate');
        $keywords = I('keywords');

        $where = array();

        if( !empty($sdate) ){
            // 1天的最大时间 518400
            $date_time = strtotime($sdate);
            $where['create_time'] = array('BETWEEN',array($date_time,intval($date_time+518399)));
        }else if( !empty($keywords) ){
            $where['title'] = array('like',"%$keywords%");
        }
        
       
        
        $m = M('FrameBase');

        $count = $m->where($where)->count();

        $Page = getPage($count);
        $show = $Page->show();

        $list = $m->where($where)->limit($Page->firstRow,$Page->listRows)->order(C('ADMINS_ORDER_STR'))->select();
       
        $this->assign('list',$list);
        $this->assign('page',$show);

        $this->display();
    }

    public function add(){

        if(IS_AJAX){
            
            $m = D('FrameBase');
            if( !$m->create() ){
                $this->ajaxReturn( return_array( $m->getError() ) );
            }else{
                $ret = $m->add();

                if($ret !== false){
                    clearFrameData();
                    $this->ajaxReturn(return_array('添加栏目信息成功！',0,1,U('index')));
                }else{
                    $this->ajaxReturn( return_array('添加栏目信息失败！') );
                }
                    
            }
        }

        $list = get_frame();
        $this->assign('list',$list);
        $this->display('edit');
    }

    public function edit(){

        if(IS_AJAX){

            $m = D('FrameBase');
            
            if( !$m->create() ){
                $this->ajaxReturn( return_array( $m->getError() ) );
            }else{
              
               $ret = $m->save();
               
                if($ret !== false){
                    clearFrameData();
                    $this->ajaxReturn(return_array('修改栏目信息成功！',0,1,U('index')));
                }else{
                    $this->ajaxReturn( return_array('修改栏目信息失败！') );
                }
                    
            }
           
        }

        $id = I('id',0,'intval');
        $m = M('FrameBase');
        $data = $m->where('id = %d',$id)->find();

        $list = get_frame();

        $this->assign('list',$list);
        $this->assign('data',$data);
        $this->display();
    }

    public function del(){
        $id = I('post.id');

        if(empty($id)){
            $this->ajaxReturn(return_array('请选择您要删除的信息'));
        }
        $id = json_decode(htmlspecialchars_decode($id),true);
       
        $m = M('FrameBase');

        if(is_array($id))
            $result = $m->where(array('Id'=>array('in',$id)))->delete();
        else
            $result = $m->where(array('Id'=>$id))->delete();

        if($result === false)
            $this->ajaxReturn(return_array('删除失败'));
        else
            $this->ajaxReturn(return_array('删除成功！',0,1,1));

    }

   

}