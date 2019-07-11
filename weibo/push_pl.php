<?php
	 header("Content-Type: text/html; charset=gbk");
   #1.数据库连接
     require("init.php");
	 
   #2.接收前端传递过来的数据
     $ptext=$_REQUEST["ptext"];
	 $weibo_id=$_REQUEST["weibo_id"];
	 
	#3.拼接slq语句
	 $sql="insert into wbpinglun(ptext,pcreate_time,weibo_id) values('$ptext',now(),'$weibo_id')";
	
	#4.执行sql并获取结果
	 $result=mysqli_query($conn,$sql);
	
	#5.根据结果输入响应
	 if($result==true){
		$sql="update weibo set pinglun_num=pinglun_num+1,weibo_last_modify_time=now() where weibo_id='$weibo_id'";
		$result = mysqli_query($conn,$sql);
		if($result==true){
			echo "ok";
		}
	 }else{
	    echo "fail";
	 }
?>