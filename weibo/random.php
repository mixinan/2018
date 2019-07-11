<?php
     #1.数据库连接
	 require("init.php"); 
	 #2.拼sql语句
	 $sql="select * from weibo order by rand() limit 1";
	 #3.执行查询，并得到结果
     $result=mysqli_query($conn,$sql);
	 $row=mysqli_fetch_row($result);
	 #var_dump($row);
	 #print_r($row);
	 $res = "第<b>$row[0]</b>条 <a href='pinglun.php?id=$row[0]'>评论($row[4])</a> <span style='margin-left:15px; font-size:0.5rem;'>$row[2]</span><br><br>$row[1] ";
	 echo $res;
?>