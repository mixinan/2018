<?php
	 $wbid=53;

     #1.数据库连接
	 require("../things/init.php"); 
	 #2.拼sql语句
	 $sql_last_plid="select pid from wbpinglun where weibo_id=$wbid order by pid desc limit 1";
	 
	 
	 #3.执行查询，并得到结果
	 $row=mysqli_query($conn,$sql_last_plid);
	 
	 $row=mysqli_fetch_row($row);
	 

	 #echo "<pre>";
	 #print_r($row);
	 #echo "</pre>";
	 
	 
	 $last_plid=$row[0];
	 
	 echo $last_plid;
?>