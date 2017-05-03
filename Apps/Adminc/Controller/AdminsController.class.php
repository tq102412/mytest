<?php
namespace Adminc\Controller;
use Think\Controller;

class AdminsController extends BaseController{

    public function index(){

        $sdate = I('sdate');
        $keywords = I('keywords');

        $where = array();

        if( !empty($sdate) ){
            // 1天的最大时间 518400
            $date_time = strtotime($sdate);
            $where['create_time'] = array('BETWEEN',array($date_time,intval($date_time+518399)));
        }else if( !empty($keywords) ){
            $where['name'] = array('like',"%$keywords%");
            $where['nickname'] = array('like',"%$keywords%");
            $where['email'] = array('like',"%$keywords%");
            $where['_logic'] = 'or';
        }
        
       
        
        $m = M('AdminBase');

        $count = $m->where($where)->count();

        $Page = getPage($count);
        $show = $Page->show();

        $list = $m->table('think_admin_base a')
        ->join('left join `think_auth_group` g on g.id = a.group ')
        ->where($where)
        ->limit($Page->firstRow,$Page->listRows)
        ->order('a.order asc,a.Id desc,a.create_time desc')
        ->field('a.id as id, a.name as name,g.title as title,a.nickname as nickname,a.email as email,g.title as title, a.create_time as create_time, a.create_ip as create_ip')
        ->select();

        
       
     
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
                $m->startTrans();
                $ret = $m->add();
                $ret2 = setGroup($ret,I('group'));
                if($ret !== false && $ret2 !== false){
                    $m->commit();
                    $this->ajaxReturn(return_array('添加用户信息成功！',0,1,U('index')));
                }else{
                    $m->rollback();
                    $this->ajaxReturn( return_array('添加用户信息失败！') );
                }
                    
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
                $m->startTrans();
                $ret = $m->save();

                
                $ret2 = setGroup(I('Id'),I('group'));
                if($ret !== false && $ret2 !== false){
                    $m->commit();
                    $this->ajaxReturn(return_array('修改用户信息成功！',0,1,U('index')));
                }else{
                    $m->rollback();
                    $this->ajaxReturn( return_array('修改用户信息失败！') );
                }
               
                
            }
           
        }


        $id = I('id',0,'intval');
        if($id <= 0 ) $this->error( '参数错误！' );
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
            $this->ajaxReturn(return_array('删除成功！',0,1,1));

    }

   




}