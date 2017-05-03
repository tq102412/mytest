<?php
namespace Adminc\Model;
use Think\Model;

class AuthRuleModel extends Model{

    protected $_validate = array(
        array('name','require','权限规则不能为空！',1,'regex',3),
        array('name','','权限规则已经存在！',1,'unique',3),
        array('title','require','权限名称不能为空！',1,'regex',3),
        array('type','0,1','附加规则状态不正确！',0,'in',3),
        array('status','0,1','规则状态不正确！',0,'in',3),
    );

    protected function _before_write(&$data){
        $data['order'] == '0' and $data['order'] = '999999';
    }
}