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
			var self_url = "/index.php/Adminc/Admins";
			keditor_options.uploadJson =  "<?php echo U('Upload/upload');?>";
    		keditor_options.fileManagerJson= "<?php echo U('Upload/manager');?>";
		</script>

	</head>

	<body>
<div class="header">
    <div class="float-right">欢迎您! <?php echo session('admin_name');?> <a href="/"><i class="icon-home"></i>网站首页</a></div>
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
        <form method="post" id="myform" action="/index.php/Adminc/Admins/add">
    <input type="hidden" name="Id" value="<?php echo ($data["id"]); ?>" />
	<div class="form-group">
		<div class="label">
			<label for="name">用户名</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="name" name="name"  value="<?php echo ($data["name"]); ?>" placeholder="请输入用户名" />
		</div>
	</div>
	<div class="form-group">
		<div class="label">
			<label for="pwd">密码（为空时不修改）</label>
		</div>
		<div class="field">
			<input type="password" class="input" id="pwd" name="pwd"  value="" placeholder="请输入密码" />
		</div>
	</div>
	
    <div class="form-group">
		<div class="label">
			<label for="email">邮箱</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="email" name="email"  value="<?php echo ($data["email"]); ?>" placeholder="请输入邮箱" />
		</div>
	</div>
    <div class="form-group">
		<div class="label">
			<label for="nickname">昵称</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="nickname" name="nickname"  value="<?php echo ($data["nickname"]); ?>" placeholder="请输入昵称" />
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label for="group">用户组</label>
		</div>
		<div class="field">
			<select class="input" name="group">
                <?php $_result=getGroup();if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php if(($v["id"]) == $data['group']): ?>selected="selected"<?php endif; ?> ><?php echo ($v["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
	</div>
    

	<div class="form-group">
		<div class="label">
			<label>是否启用</label>
		</div>
		<div class="field">
			<div class="button-group radio">

                <?php if(($data['state']) == "0"): ?><label class="button active">
					    <input name="state" value="0"  checked="checked"  type="radio"><span class="icon icon-check"></span> 启用
				    </label>
                    <label class="button">
					    <input name="state" value="1"  type="radio"><span class="icon icon-check"></span> 禁用
				    </label>
                <?php else: ?>
                    <label class="button">
					    <input name="state" value="0"  type="radio"><span class="icon icon-check"></span> 启用
				    </label>
                    <label class="button active">
					    <input name="state" value="1"  checked="checked"  type="radio"><span class="icon icon-check"></span> 禁用
				    </label><?php endif; ?>

			</div>
		</div>
	</div>
   
    
    <div class="form-button">
		<button class="button" type="button" onClick="AjaxForm('#myform')" >保存</button>
	</div>
</form>
    </div>
</div>



    </body>
</html>