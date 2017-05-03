<?php
namespace Adminc\Model;
use Think\Model;

class AdminBaseModel extends Model{

    
    protected $_auto = array(
        array('create_time','time',1,'function'),
        array('create_ip','get_client_ip',1,'function'),
       
    );

    protected $_validate = array(
        array('name','require','用户名不能为空！',0,'regex',3),
        array('name','','用户名已经存在！',1,'unique',3),
        array('nickname','require','昵称不能为空！',0,'regex',3),
        array('group','require','请选择用户组!',1,'regex',3),
    );

    protected function _before_write(&$data){
        if(empty($data['pwd'])){
            unset($data['pwd']);
        }else{
            $data['pwd'] = get_md5($data['pwd']);
        }
        $data['order'] == '0' and $data['order'] = '999999';
    }



}