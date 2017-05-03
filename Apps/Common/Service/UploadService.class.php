<?php
namespace Common\Service;
use Think\Controller;

class UploadService{


    public function upload(){

        $path = '/Public/attached/';
        $conf = array(
            'rootPath'      =>  './Public/attached/', //保存根路径
            'subName'       =>  array('date', 'Ymd'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'exts'          =>  array('gif', 'jpg', 'jpeg', 'png', 'bmp'), //允许上传的文件后缀
            'maxSize'       =>  10240000, //上传的文件大小限制 (0-不做限制)
        );

        $upload = new \Think\Upload($conf);
        
        $info   =   $upload->upload();

        if(!$info) {// 上传错误提示错误信息
            $this->alert($upload->getError());
        }else{// 上传成功
            $file_url =$path.$info['file']['savepath'] . $info['file']['savename'];
            header('Content-Type: text/html; charset=utf-8');
            exit(json_encode(array('error' => 0, 'url' => $file_url)));
        }

    }



    public function manager(){
        

       
        $current_dir_path = trim($_GET['path']);

        //图片扩展名
        $ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');

        //目录路径
		$root_path = './Public/attached/' . $dir_name . '/';

        
        if (!file_exists($root_path)) {
            mkdir($root_path, 0644, TRUE) && chmod($root_path, 0644);
        }

        //根据path参数，设置各路径和URL
        $current_path    = $root_path . $current_dir_path;
        $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);

        //不允许使用..移动到上一级目录
        if (preg_match('/\.\./', $current_path)) {
            $this->alert('Access is not allowed.');
        }
        //最后一个字符不是/
        if (!preg_match('/\/$/', $current_path)) {
            $this->alert('Parameter is not valid.');
        }
        //目录不存在或不是目录
        if (!file_exists($current_path) || !is_dir($current_path)) {
            $this->alert('Directory does not exist.');
        }

        //遍历目录取得文件信息
        $file_list = array();
        if ($handle = opendir($current_path)) {
            $i = 0;
            while (false !== ($filename = readdir($handle))) {
                if ($filename{0} == '.') continue;
                $file = $current_path . $filename;
                if (is_dir($file)) {
                    $file_list[$i]['is_dir'] = true; //是否文件夹
                    $file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
                    $file_list[$i]['filesize'] = 0; //文件大小
                    $file_list[$i]['is_photo'] = false; //是否图片
                    $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
                } else {
                    $file_list[$i]['is_dir'] = false;
                    $file_list[$i]['has_file'] = false;
                    $file_list[$i]['filesize'] = filesize($file);
                    $file_list[$i]['dir_path'] = '';
                    $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
                    $file_list[$i]['filetype'] = $file_ext;
                }
                $file_list[$i]['filename'] = $filename; //文件名，包含扩展名
                $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
                $i++;
            }
            closedir($handle);
        }

        //排序
        function cmp_func($a, $b) {
            //排序形式，name or size or type
            $order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

            if ($a['is_dir'] && !$b['is_dir']) {
                return -1;
            } else if (!$a['is_dir'] && $b['is_dir']) {
                return 1;
            } else {
                if ($order == 'size') {
                    if ($a['filesize'] > $b['filesize']) {
                        return 1;
                    } else if ($a['filesize'] < $b['filesize']) {
                        return -1;
                    } else {
                        return 0;
                    }
                } else if ($order == 'type') {
                    return strcmp($a['filetype'], $b['filetype']);
                } else {
                    return strcmp($a['filename'], $b['filename']);
                }
            }
        }
        usort($file_list, 'cmp_func');


        $result = array(
			'moveup_dir_path'  => $moveup_dir_path,//相对于根目录的上一级目录
			'current_dir_path' => $current_dir_path,//相对于根目录的当前目录
			'current_url'      => '/' . $current_path,//当前目录的URL
			'total_count'      => count($file_list),//文件数
			'file_list'        => $file_list,//文件列表数组
		);

        //输出JSON字符串
        header('Content-type: application/json; charset=UTF-8');
        exit(json_encode($result));

    }


    private function alert($msg)
	{
		header('Content-type: text/html; charset=UTF-8');
		exit(json_encode(array('error' => 1, 'message' => $msg)));
	}


}