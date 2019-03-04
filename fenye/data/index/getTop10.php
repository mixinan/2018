<?php
//data/index/getTop10.php
header("Content-Type:application/json");
require_once("../init.php");
$sql="select * from weibo order by weibo_id desc limit 10";
$result=mysqli_query($conn,$sql);
echo json_encode(mysqli_fetch_all($result,1));