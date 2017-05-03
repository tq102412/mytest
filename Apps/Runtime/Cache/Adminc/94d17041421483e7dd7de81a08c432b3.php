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
		<title><?php echo C('SYSTEM_WEBNAME');?>-后台管理系统</title>
		<link rel="shortcut icon" href="/favicon.ico"/>
		<link rel="bookmark" href="/favicon.ico"/>

		<link rel="stylesheet" href="/Public/Adminc/css/admin.css">
		<link rel="stylesheet" href="/Public/Lib/pintuer/pintuer.css">

		
		<script src="/Public/Lib/require.js"></script>
        <script src="/Public/Lib/main.js" ></script>
        <script src="/Public/Adminc/js/admin.js" ></script>
		<script>require(['layer','pintuer','respond']);</script>
		<script>
			var self_url = "/index.php/Auth";
			keditor_options.uploadJson =  "<?php echo U('Upload/upload');?>";
    		keditor_options.fileManagerJson= "<?php echo U('Upload/manager');?>";
		</script>

	</head>

	<body>
<div class="header">
    <div class="float-right">超级管理员 admin <a href="/"><i class="icon-home"></i>网站首页</a></div>
    <div class="float-left"><?php echo C('SYSTEM_NAME');?>后台管理系统</div>
</div>
<div class="float-left leftnav border-right">
    <dl>
        <dt><i class="icon-file-text"></i> 内容管理<i class="icon-angle-down float-right f-22"></i></dt>
        <dd>
            <ul>
                <li><a href="<?php echo U('Topic/index');?>">内容列表</a></li>
                <li><a href="<?php echo U('Topic/add');?>">添加内容</a></li>
            </ul>
        </dd>
    </dl>
    <dl>
        <dt><i class="icon-th-list"></i> 栏目管理<i class="icon-angle-down float-right f-22"></i></dt>
        <dd>
            <ul>
                <li><a href="<?php echo U('Frame/index');?>">栏目列表</a></li>
                <li><a href="<?php echo U('Frame/add');?>">添加栏目</a></li>
            </ul>
        </dd>
    </dl>
    <dl>
        <dt><i class="icon-unlock-alt"></i> 权限管理<i class="icon-angle-down float-right f-22"></i></dt>
        <dd>
            <ul>
                <li><a href="<?php echo U('Auth/index');?>">权限列表</a></li>
                <li><a href="<?php echo U('Group/index');?>">用户组列表</a></li>
            </ul>
        </dd>
    </dl>
    <dl>
        <dt><i class="icon-user"></i> 管理员管理<i class="icon-angle-down float-right f-22"></i></dt>
        <dd>
            <ul>
                <li><a href="<?php echo U('Admins/index');?>">用户列表</a></li>
                <li><a href="<?php echo U('Admins/add');?>">添加用户</a></li>
            </ul>
        </dd>
    </dl>
</div>

<div class="right-content">
    
    <div class="admin">
        <div class="margin-large-bottom my-title-bg padding border">
    <a class="button bg-main mydelall"><i class="icon-trash-o"></i> 批量删除</a>
    <a href="add.html" class="button bg-sub"><i class="icon-plus"></i> 添加权限</a>
</div>
<div class="panel">
    <div class="panel-head">权限列表</div>
	<div class="panel-body">
        <table class="table table-hover my-table">
            <tr>
                <th><input type="checkbox" name="" value=""></th>
                <th>ID</th>
                <th>规则</th>
                <th>名称</th>
                <th>附加规则</th>
                <th>状态</th>
                <th>序号</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                <td><input type="checkbox" name="id" value="<?php echo ($v["id"]); ?>"></td>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["name"]); ?></td>
                <td><?php echo ($v["html"]); ?> <?php echo ($v["title"]); ?></td>
                <td><?php echo ($v["condition"]); ?></td>
                <td><?php echo ($v["status"]); ?></td>
                <td><?php echo ($v["order"]); ?></td>
                <td><a href="<?php echo U('edit',array('id'=>$v['id']));?>" class="icon-pencil margin-right">编辑</a> <a href="javascript:;" data-id="<?php echo ($v["id"]); ?>" class="icon-times mydel">删除</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        
	</div>
    <div class="panel-foot text-center">
		<div class="pagination pagination-group mypage"><?php echo ($page); ?></div>
	</div>
</div>
    </div>
</div>



    </body>
</html>