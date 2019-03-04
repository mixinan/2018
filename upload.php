<?php 
	header("Content-Type:text/html;charset=utf-8");
	//echo "<pre>";
	//var_dump($_FILES);
	//echo "</pre>";
	//echo "<hr>";

	$file = $_FILES['f'];
	$t_file=$file['tmp_name'];
	$name=$file['name'];
	//echo $name;
	
	$name=iconv('utf-8', 'gbk', $name);
	$d_file='/webdata/jianli/'.$name;
	//echo $d_file;
	//chmod($t_file, 0777);

	$result=move_uploaded_file($t_file, $d_file);
	var_dump($result);
	echo "<script language='javascript'>";
	echo "window.location.href='./jianli/'";
	echo "</script>";
 