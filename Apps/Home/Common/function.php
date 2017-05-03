<?php


function getNav(){

    $data = S('framedata');

    if( empty($data) ){
        $data = array_filter($data,function($v){ return $v['is_nav'] == '1'; } );
    }
        
    return $data;
}