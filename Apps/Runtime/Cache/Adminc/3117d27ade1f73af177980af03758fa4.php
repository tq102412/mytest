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
			var self_url = "/index.php/Adminc/Topic";
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
        <div class="panel">
	<div class="panel-head">内容管理</div>
	<div class="panel-body">
		<div class="padding border-bottom">
			<a class="button bg-main mydelall"><i class="icon-trash-o"></i> 批量删除</a>
    		<a href="<?php echo U('add',array('fid'=>$_GET['fid']));?>" class="button bg-sub"><i class="icon-plus"></i> 添加文章</a>
			
			<div class="form-group x3 float-right">
				<div class="field">
					<form id="myform" method="get" action="/index.php/Adminc/Topic/ls" >
						<input name="fid" type="hidden" value="<?php echo ($_GET['fid']); ?>" />
						<div class="input-group">
								<input type="text" class="input" name="keywords" size="50" placeholder="关键词" /><span class="addbtn">
							<button  type="submit" class="button">
								搜索</button></span>
						</div>
					</form>
				</div>
			</div>
			<div class="form-group x3 float-right margin-right">
				<div class="field">
					<div class="input-group">
						<input type="text"   id="mylaydate" class="input mylaydate" name="sdate" size="50" placeholder="时间段" />
					</div>
				</div>
			</div>
		</div>
		<?php if(empty($list)): ?><p class="margin padding-big">该栏目没有对应的内容！</p>
		<?php else: ?>
		<table class="table table-hover">
			<tr>
				<th width="45">选择</th>
				
				<th width="*">标题</th>
				<th width="50">审核</th>
				<th width="50">置顶</th>
				<th width="80">排序</th>
				<th width="120">发布者</th>
				<th width="200">发布时间</th>
				<th width="100">操作</th>
			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
				<td>
					<input type="checkbox" name="id" value="<?php echo ($v["id"]); ?>" />
				</td>
				<td><a href="<?php echo U('Topic/edit',array('id'=>$v['id']));?>"><?php echo ($v["title"]); ?></a></td>
				<td><a href="javascript:;" class="setajax" data-id="<?php echo ($v["id"]); ?>" data-method="state" data-value="<?php if(($v["state"]) == "1"): ?>0<?php else: ?>1<?php endif; ?>"><i class="icon-eye <?php if(($v["state"]) == "1"): else: ?>text-gray<?php endif; ?>"></i></a></td>
				<td><a href="javascript:;" class="setajax" data-id="<?php echo ($v["id"]); ?>" data-method="is_top" data-value="<?php if(($v["is_top"]) == "1"): ?>0<?php else: ?>1<?php endif; ?>"><i class="icon-thumb-tack <?php if(($v["is_top"]) == "1"): else: ?>text-gray<?php endif; ?>"></i></a></td>
				<td><?php echo ($v["order"]); ?></td>
				<td><?php echo ($v["nickname"]); ?></td>
				<td><?php echo (date('Y-m-d H:i:s',$v["create_time"])); ?></td>
				<td><a class="button border-blue button-little" href="<?php echo U('Topic/edit',array('id'=>$v['id']));?>">修改</a> <a data-id="<?php echo ($v["id"]); ?>" class="button border-yellow button-little mydel" href="javascript:;" >删除</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			
		</table><?php endif; ?>
	</div>
	<div class="panel-foot text-center">
		<div class="pagination pagination-group mypage"><?php echo ($page); ?></div>
	</div>
</div>

<script>
    require(['laydate'],function(){
        $(function(){
            $('#mylaydate').on('click',function(){
                laydate({
                    choose: function(dates){ //选择好日期的回调
                        
                        window.location.href="/index.php/Adminc/Topic/ls?fid=<?php echo ($_GET['fid']); ?>&sdate="+dates;
                    }
                });
            })
        }) 
    });
</script>
    </div>
</div>



    </body>
</html>