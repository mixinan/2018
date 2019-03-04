<?php
  //创建到服务器的连接
    $conn=mysqli_connect("ip address","username","passwd","database",3306);
    $sql="SET NAMES UTF8";

	mysqli_query($conn,$sql);

?>
