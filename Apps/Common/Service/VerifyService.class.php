<?php
namespace Common\Service;
use Think\Verify;

class VerifyService{

    // 默认配置
    private $conf = array(
        'fontSize' => 25,
        'length' => 4,
        'codeSet' => '2345678',
        'useNoise' => false,
    );


    /**
     * 创建一个验证码
     * @access public
     * @param string $name 名称
     * @param mixed $value 值
     * @return void
     */
    public function create($id = ''){


        $verify = new Verify();
        foreach($this->conf as $k=>$v){
            $verify->$k = $v;
        }

        $verify->entry($id);
        
    }

    /**
    *
    * 验证图形验证码
    * @access public
    * @param  string  $code  验证码字符串
    * @param  string  $id    验证码id
    * @return bool
    *
    */
    public function check_verify($code, $id = ''){
        $verify = new Verify();
        return $verify->check($code, $id);
    }


    /**
     * 设置配置对象的值
     * @access public
     * @param string $name 名称
     * @param mixed $value 值
     * @return void
     */
    public function __set($name,$value) {
        // 设置数据对象属性
        $this->conf[$name]  =   $value;
    }


    /**
     * 批量设置配置对象的值
     * @access public
     * @param array $conf 值
     * @return void
     */
    public function conf( $conf = array() ){
        if(empty($conf)){
            foreach($conf as $k=>$v){
                $this->conf[$k] = $v;
            }
        }
    }


}