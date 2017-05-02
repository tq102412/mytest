<?php
namespace Common\Service;
use Think\Verify;

class VerifyService{

    private $conf = array(
        'fontSize' => 25,
        'length' => 4,
        'codeSet' => '2345678',
        'useNoise' => false,
    );

    public function create($id = ''){


        $verify = new Verify();
        foreach($this->conf as $k=>$v){
            $verify->$k = $v;
        }

        $verify->entry($id);
        
    }


    

    public function conf( $conf = array() ){
        if(empty($conf)){
            foreach($conf as $k=>$v){
                $this->conf[$k] = $v;
            }
        }
    }


}