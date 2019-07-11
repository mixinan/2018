<?php
   #增加：响应消息头
   header("Content-Type:application/json");
     #1.数据库连接
	 require("init.php"); 
	 #2.拼sql语句
	 $sql="select * from weibo order by weibo_last_modify_time desc";
	 #3.执行查询，并得到结果
     $result=mysqli_query($conn,$sql);
	 #4.将查询结果转换为关联数组
	 $array=mysqli_fetch_all($result,MYSQLI_ASSOC);
     #var_dump($array);
	 #5.将关联数组转换为JSON格式并响应
	 echo json_encode($array);

?>