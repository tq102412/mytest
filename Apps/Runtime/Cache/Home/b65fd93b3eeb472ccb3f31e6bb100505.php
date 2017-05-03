<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">
        <meta name="author" content="<?php echo C('SYSTEM_AUTHOR');?>">
        <meta name="keywords" content="<?php echo C('SYSTEM_KEYWORDS');?>">
        <meta name="description" content="<?php echo C('SYSTEM_DESCRIPTION');?>">
		<title><?php echo C('SYSTEM_WEBNAME');?>-home</title>
		<link rel="shortcut icon" href="/favicon.ico"/>
		<link rel="bookmark" href="/favicon.ico"/>

		<link rel="stylesheet" href="/Public/Home/css/home.css">

		
		<script src="/Public/Lib/require.js"></script>
        <script src="/Public/Lib/main.js" ></script>
        <script src="/Public/Home/js/home.js" ></script>
		<script>require(['layer','pintuer']);</script>

	</head>

	<body>
<div class="header">
    <div class="nav">
        <?php $_result=getNav();if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U('index',array('id'=>$v['id']));?>"><?php echo ($v['title']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>




<div class="content">
    <ul class="content_list">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('news',array('id'=>$v['id']));?>"><?php echo ($v["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>


<div class="footer">
   
</div>

    </body>
</html>