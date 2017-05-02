<?php

/**
 *
 * 获取栏目分类
 * @param   int    需要获取的栏目ID，-1表示获取全部分类
 * @return  array
 *
 */
function get_frame($frame=-1){

    $m = M('frame_base');

    if($frame==-1){
        
        $data = $m->where('fb_state = 1')->select();
        $data2 = serialize_frame($data);
    }else{
        $frame = intval($frame);
        $data2 = $m->where(array('fb_state'=>1,'fb_id'=>$frame));
    }

    return $data2;
}

/**
 *
 * 序列化栏目分类
 * @param   array  $data  需要序列化的栏目数据
 * @param   int  $pid   父栏目ID
 * @param   int  $level 栏目等级
 * @param   string  $html  栏目在html中各个级别的展示
 * @return  array
 *
 */
function serialize_frame($data,$pid=0,$level=0,$html="├ "){

    static $newdata = array();

    foreach($data as $k=>$v){

        if($v['fb_parent_id'] == $pid){
            $v['level'] = $level;
            $v['html'] = str_repeat($html,$level);
            $newdata[] = $v;
            unset($data[$k]);
            serialize_frame($data,$v['fb_id'],$level+1);
        }
       
    }

    return $newdata;

    
}


/**
 * 设置分页属性
 * @param array $totalRows  总的记录数
 * @param array $listRows  每页显示记录数
 * @param array $parameter  分页跳转的参数
 */
function getPage($totalRows,$listRows=30,$parameter = array()){

    $Page = new \Think\Page($totalRows,$listRows);

    $Page->lastSuffix = false;
    $Page->setConfig('prev','«');
    $Page->setConfig('next','»'); 
    $Page->setConfig('theme','%UP_PAGE% %LINK_PAGE% %DOWN_PAGE%');

    return $Page;
}



/**
 * 拿序列化后的权限列表
 * @return array
 *
 */

function getRuleList(){

    $m = M('auth_rule');

    $data = $m->order('ordernum asc')->select();
    $data2 = serialize_rule($data);


    return $data2;
}


/**
 *
 * 序列化权限规则
 * @param   array  $data  需要序列化的栏目数据
 * @param   int  $pid   父栏目ID
 * @param   int  $level 栏目等级
 * @param   string  $html  栏目在html中各个级别的展示
 * @return  array
 *
 */
function serialize_rule($data,$pid=0,$level=0,$html="├ "){

    static $newdata = array();

    foreach($data as $k=>$v){

        if($v['parentid'] == $pid){
            $v['level'] = $level;
            $v['html'] = str_repeat($html,$level);
            $newdata[] = $v;
            unset($data[$k]);
            serialize_rule($data,$v['id'],$level+1);
        }
       
    }

    return $newdata;

    
}