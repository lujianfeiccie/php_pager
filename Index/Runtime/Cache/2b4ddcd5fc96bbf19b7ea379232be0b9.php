<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" type="text/css" href="../../css/all.css">
</head>
<body>
	
	<ul>
        <?php if(is_array($list)): foreach($list as $key=>$value): ?><li><?php echo ($value["id"]); ?>&nbsp;<?php echo ($value["name"]); ?> &nbsp; <a href="del?id=<?php echo ($value["id"]); ?>">删除</a></li><?php endforeach; endif; ?>
    </ul>
    <form method="post" action="add">
    	<input name="name" type="text" value="">
    	<input type="submit" value="新增" />
    </form>
</body>
</html>