<?php
	 header("Content-Type: text/html; charset=gbk");
   #1.数据库连接
     require("init.php");
	 
   #2.接收前端传递过来的数据
     $text=$_REQUEST["text"];
	 
	#3.拼接slq语句
	 $sql="insert into weibo(weibo_text,weibo_create_time) values('$text',now())";
	#4.执行sql并获取结果
	 $result=mysqli_query($conn,$sql);
	#5.根据结果输入响应
	 if($result==true){
		echo "ok";
	 }else{
	    echo "fail";
	 }
?>