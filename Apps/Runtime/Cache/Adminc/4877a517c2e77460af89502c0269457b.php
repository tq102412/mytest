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
			var self_url = "/index.php/Frame";
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
                <li><a href="<?php echo U('Topic/index');?>">内容管理</a></li>
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
        
<form method="post" id="myform" action="/index.php/Frame/edit">
    <input type="hidden" name="Id" value="<?php echo ($data["id"]); ?>" />
	<div class="form-group">
		<div class="label">
			<label for="title">栏目标题</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title" name="title"  value="<?php echo ($data["title"]); ?>" placeholder="请输入栏目标题" />
		</div>
	</div>
	<div class="form-group">
		<div class="label">
			<label for="title_sub">栏目副标题</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="title_sub" name="title_sub"  value="<?php echo ($data["title_sub"]); ?>" placeholder="请输入栏目副标题" />
		</div>
	</div>
    <div class="form-group">
		<div class="label">
			<label for="parent_id">上级栏目</label>
		</div>
		<div class="field">
			<select class="input" name="parent_id">
				<option value="0">顶级栏目</option>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php if(($v["id"]) == $data['parent_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($v["html"]); echo ($v["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
	</div>
    <div class="form-group">
		<div class="label">
			<label for="img">缩略图</label>
		</div>
		<div class="field input-inline">
			<input type="text" class="input margin-right" size="80" name="img" id="img" value="<?php echo ($data["img"]); ?>"/><a class="button input-file k_btn" data-mode="image" href="javascript:void(0);">+ 浏览文件</a>
		</div>
	</div>
    <div class="form-group">
		<div class="label">
			<label for="pagesize">每页显示条数</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="pagesize" name="pagesize" value="<?php echo ($data["pagesize"]); ?>"  placeholder="请输入每页显示条数" />
		</div>
	</div>
	<div class="form-group">
		<div class="label">
			<label for="remark">备注</label>
		</div>
		<div class="field">
			<input type="text" class="input" id="remark" name="remark"  value="<?php echo ($data["remark"]); ?>" placeholder="请输入备注信息" />
		</div>
	</div>
    
	<div class="form-group">
		<div class="label">
			<label>栏目导航</label>
		</div>
		<div class="field">
			<div class="button-group radio">

                <?php if(($data['is_nav']) == "1"): ?><label class="button active">
                        <input name="is_nav" value="1"  checked="checked"  type="radio"><span class="icon icon-check"></span> 是
                    </label>
                    <label class="button">
                        <input name="is_nav" value="0"  type="radio"><span class="icon icon-times"></span> 不是
                    </label>
                <?php else: ?>
                    <label class="button">
                        <input name="is_nav" value="1"  type="radio"><span class="icon icon-check"></span> 是
                    </label>
                    <label class="button active">
                        <input name="is_nav" value="0"  checked="checked"  type="radio"><span class="icon icon-times"></span> 不是
                    </label><?php endif; ?>

			</div>
		</div>
	</div>
    <div class="form-group">
		<div class="label">
			<label>是否启用</label>
		</div>
		<div class="field">
			<div class="button-group radio">

                <?php if(($data['state']) == "1"): ?><label class="button active">
					    <input name="state" value="1"  checked="checked"  type="radio"><span class="icon icon-check"></span> 是
				    </label>
                    <label class="button">
					    <input name="state" value="0"  type="radio"><span class="icon icon-times"></span> 不是
				    </label>
                <?php else: ?>
                    <label class="button">
					    <input name="state" value="1"  type="radio"><span class="icon icon-check"></span> 是
				    </label>
                    <label class="button active">
					    <input name="state" value="0"  checked="checked"  type="radio"><span class="icon icon-times"></span> 不是
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