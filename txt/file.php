<?php
	
	$uname=$_REQUEST["uname"];
	$uphone=$_REQUEST["uphone"];
	
	$content = "name:".$uname." phone:".$uphone."\n";
	
	//echo $content;
	
	$f = fopen('./info.txt', 'a+'); //在文件末尾追加数据
	$boo = fwrite($f, $content);
	fclose($f);
	if($boo){
		echo "提交成功";
	}else{
		echo "出错";
	}
?>