<?php
namespace Adminc\Model;
use Think\Model;

class TopicBaseModel extends Model{

    
    protected $_auto = array(
        array('create_time','time',1,'function'),
        array('create_ip','get_client_ip',1,'function'),
        array('create_user','setUid',1,'callback'),
        array('edit_time','time',2,'function'),
        array('edit_ip','get_client_ip',2,'function'),
        array('edit_user','setUid',2,'callback'),
    );

    protected $_validate = array(
        array('title','require','栏目标题不能为空！',0,'regex',3),
    );

    protected function setUid(){

        return session('admin_id');
    }
    
    protected function _before_write(&$data){
        $data['order'] == '0' and $data['order'] = '999999';
        
    }

}