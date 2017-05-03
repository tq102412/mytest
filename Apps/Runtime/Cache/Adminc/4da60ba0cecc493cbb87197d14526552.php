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
			var self_url = "/index.php/Adminc/Group";
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
        
<form method="post" class="myauthform" id="myform" action="<?php echo U('rules');?>">
    <input type="hidden" name="id" value="<?php echo I('id');?>" />
    <div  class="myauthk bg radius border  padding-top padding-bottom padding-big-left">
        <i class="icon-cube"></i> 菜单模块
		<i class="icon-cubes margin-left"></i> 功能模块
		<i class="icon-edit  margin-left"></i> 操作
        <a onClick="AjaxForm('#myform')" class="button bg-sub float-right margin-right"><i class="icon-pencil"></i> 保存</a>
    </div>
    
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo['level']) == "0"): if(($i) != "1"): ?></div><?php endif; ?>
                    <div class="panel margin-top">
                        <div class="panel-head">
                            <i class="icon-cube"></i> <?php echo ($vo["title"]); ?>
                        </div>
                    <?php if(isset($list[$i])): ?><div class="panel-body"><?php endif; endif; ?>
           
            <?php if(($vo['level']) == "1"): ?><div class="margin-bottom"><input <?php if(in_array($vo['id'],$rules_arr)): ?>checked="checked"<?php endif; ?> type="checkbox" id="ids_<?php echo ($vo["id"]); ?>" level="1" name="access[]"  value="<?php echo ($vo["id"]); ?>"> <i class="icon-cubes margin-left-small "></i> <label for="ids_<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></label></div>

                <?php if(isset($list[$i])): if(($list[$i][level]) == "2"): ?><div class="line-big margin-bottom myauth">
                    <?php elseif($list[$i]['level'] == 0): ?>
                        </div><?php endif; ?>
                <?php else: ?>
               
                            </div>
                    </div><?php endif; endif; ?>

            <?php if(($vo['level']) == "2"): ?><div >
                                        <input type="checkbox" <?php if(in_array($vo['id'],$rules_arr)): ?>checked="checked"<?php endif; ?> id="ids_<?php echo ($vo["id"]); ?>" level="1" name="access[]"  value="<?php echo ($vo["id"]); ?>"><i class="icon-edit margin-left"></i> <label for="ids_<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></label>
                                    </div>
                <?php if(isset($list[$i])): if(($list[$i][level]) == "0"): ?></div><?php endif; ?>
                <?php else: ?>
                    </div><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
    
</form>
    </div>
</div>



    </body>
</html>