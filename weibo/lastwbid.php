<?php

     #1.数据库连接
	 require("init.php"); 
	 #2.拼sql语句
	 $sql="select * from weibo order by weibo_id desc limit 1";
	 
	 
	 #3.执行查询，并得到结果
	 $row=mysqli_query($conn,$sql);
	 
	 $row=mysqli_fetch_row($row);
	 

	 #echo "<pre>";
	 #print_r($row);
	 #echo "</pre>";
	 
	 
	 $last_wbid=$row[0];
	 
	 echo $last_wbid;
?>