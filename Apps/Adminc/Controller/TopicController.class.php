<?php
namespace Adminc\Controller;
use Think\Controller;

class TopicController extends BaseController{

    public function index(){
 
        $this->display();
    }


    public function ls(){


        $fid = I('fid',0,'intval');

        if($fid <= 0){
            $this->error('对不起你访问的栏目不存在或已经删除！');
        }

        $sdate = I('sdate');
        $keywords = I('keywords');

        $where = array('frame'=>$fid);

        if( !empty($sdate) ){
            // 1天的最大时间 518400
            $date_time = strtotime($sdate);
            $where['create_time'] = array('BETWEEN',array($date_time,intval($date_time+518399)));
        }else if( !empty($keywords) ){
            $where['title'] = array('like',"%$keywords%");
        }
        
        $m = D('TopicBaseView');

        $count = $m->where($where)->count();

        $Page = getPage($count);
        $show = $Page->show();

        $list = $m->where($where)->limit($Page->firstRow,$Page->listRows)->order(C('TOPIC_ORDER_STR'))->select();
       
      
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();

    }

    public function set(){

        $method = I('post.method');
        if( $method != 'state' && $method != 'is_top' ){
            $this->ajaxReturn(return_array('非法提交'));
        }

        $id = I('post.id',0,'intval');
        $value = I('post.value',0,'intval');

        if(!empty($method)){
            $m = M('TopicBase');
            $result = $m->where(array('tb_id'=>$id))->save(array($method=>$value));
           
            if($result !== false)
                $this->ajaxReturn(return_array('设置成功',0,1,1));
            else
                $this->ajaxReturn(return_array('设置失败'));
        }


    }

    public function add(){

        if(IS_AJAX){
          
            $m = D('TopicBase');
            if( !$m->create() ){
                $this->ajaxReturn( return_array( $m->getError() ) );
            }else{
                $ret = $m->add();
                if($ret !== false)
                    $this->ajaxReturn(return_array('添加信息成功！',0,1,U('ls',array('fid'=>I('frame')))));
                else
                    $this->ajaxReturn( return_array('添加信息失败！') );
            }
        }

        $fid = I('fid',0,'intval');
        $this->assign('fid',$fid);

        
        $this->display('edit');
    }

    public function edit(){

        if(IS_AJAX){

            $m = D('TopicBase');
            
            if( !$m->create() ){
                $this->ajaxReturn( return_array( $m->getError() ) );
            }else{
              
               $ret = $m->save();
               
                if($ret !== false)
                    $this->ajaxReturn(return_array('修改信息成功！',0,1,U('ls',array('fid'=>I('frame')))));
                else
                    $this->ajaxReturn( return_array('修改信息失败！') );
            }
           
        }


        $id = I('id',0,'intval');
        if($id <= 0 ) $this->error( '参数错误！' );
        $m = M('TopicBase');
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
       
        $m = M('TopicBase');

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