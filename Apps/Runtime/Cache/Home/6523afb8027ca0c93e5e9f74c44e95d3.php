<?php if (!defined('THINK_PATH')) exit();?><h1><?php echo ($data["title"]); ?></h1>
<p><?php echo (date('Y-m-d H:i:s',$data["create_time"])); ?></p>
<div>
    <?php echo ($data["content"]); ?>
</div>