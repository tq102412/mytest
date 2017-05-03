<?php
namespace Adminc\Model;
use Think\Model;

class FrameBaseModel extends Model{

    
    protected $_auto = array(
        array('create_time','time',1,'function'),
        array('create_ip','get_client_ip',1,'function'),
       
    );

    protected $_validate = array(
        array('title','require','栏目标题不能为空！',0,'regex',3),
    );

}