<?php
namespace Adminc\Model;
use Think\Model\ViewModel;

class TopicBaseViewModel extends ViewModel{

    public $viewFields = array(
     'topic_base'=>array('id','title','state','is_top','`order`','create_time','create_user'),
     'admin_base'=>array('nickname', '_on'=>'topic_base.create_user=admin_base.id'),
   );

}