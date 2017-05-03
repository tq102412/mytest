<?php
namespace Adminc\Model;
use Think\Model;

class AuthGroupModel extends Model{

    

    protected $_validate = array(
        array('title','require','用户组名称不能为空！',1,'regex',3),
        array('title','','用户组名称已经存在！',1,'unique',3),
        array('status','0,1','用户组状态不正确！',0,'in',3),
    );

    protected function _before_write(&$data){
        $data['order'] == '0' and $data['order'] = '999999';
        
    }

    
}