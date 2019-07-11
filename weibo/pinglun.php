<?php
	 $wbid=$_REQUEST["id"];

     #1.数据库连接
	 require("init.php"); 
	 #2.拼sql语句
	 $sql_wb="select * from weibo where weibo_id=$wbid";
	 $sql_pl="select * from wbpinglun where weibo_id=$wbid order by pid desc";
	 
	 #echo $sql_pl;
	 
	 #3.执行查询，并得到结果
     $result=mysqli_query($conn,$sql_pl);
	 $result_wb=mysqli_query($conn,$sql_wb);
	 
	 $array=mysqli_fetch_all($result,MYSQLI_ASSOC);
	 $row=mysqli_fetch_row($result_wb);
	 
	 #var_dump($row);
	 #echo "<pre>";
	 #print_r($row);
	 #echo "</pre>";
	 
	 $weibo = "<h4>$row[1]</h4><div class='weibo_info'>第<b>$row[0]</b>条  <span class='ptime'>$row[2]</span> 评论($row[4])</div><br> ";
	 $pinglun = json_encode($array); 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>评论</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="Keywords" content="万码千钧"/>
		<meta name="Description" content="郭兴楠的个人主页。"/>
		<script src="jquery-1.11.3.js"></script>
		<link rel="shortcut icon" href="../img/guo3.ico" type="image/x-icon">
		<style>
			div#container{
				padding-left:20px;
				position:relative;
			}
		
			div.weibo_info{
				position:absolute;
				right:20px;
			}
		
			span.ptime{
				margin:0 15px; 
				font-size:0.5rem;
			}
			
			.pl_box{
				position:relative;
			}
			
			#pl_inp{
				width:70%;
				height:66px;
			}
			
			#btn{
				font-size:1.2rem;
				padding:10px;
			}
			
			@media screen and (min-width:600px){
				div#container{
					width:50%;
					margin: 0 auto;
					text-align:center;
				}
				
			}
		</style>
	</head>
	<body>
		<div id="container">
			<input type="button" value="返 回" onclick="history.go(-1)">
			<input type="button" value="知识列表" onclick="window.location.href='./'">
			<br><br>
			<!--
				显示微博信息
			-->
			<?php  echo $weibo; ?>
			
			
			<!--
				评论区域
			-->
			<p class="pl_box">
				<textarea rows="3" id="pl_inp" placeholder="评论一下吧"></textarea>
				<button id="btn">评论</button>
			</p>
			
			
			<!--
				评论列表
			-->
			<div class="pl_list">
				<!--
					使用ajax获取数据并填充到此
				-->
			</div>
		</div>
		
		
		<script src="common.js"></script>
		<script>		
		
			var list=JSON.parse('<?php  echo $pinglun; ?>');
			// 循环遍历js数组，再拼接
			
			//console.log(list);
			var html="";
			for(var i=0;i<list.length;i++){
			 //取出响应回来数组中的每一条微博
			   var pinglun=list[i];

			   html += "<div class='pinglun_item'>";
			   //html += "<span class='uid'>"+pinglun.pid+"</span>";
			   html += "<p class='ptext' style='margin-bottom:5px;'>"+pinglun.ptext+"</p>";
			   html += "<span class='ptime'>"+pinglun.pcreate_time+"</span>";
			   html += "</div>";
			}
			
			jQuery(".pl_list").html(html);
		
		</script>
		

		
		<script>
			jQuery("#btn").click(function(){
				var text = jQuery("#pl_inp").val();
				//console.log(text);
				if(isnull(text)){
					alert("你先写点东西吧……");
					jQuery("#pl_inp").val("");
					return;
				}
				push_pl(text);
			});
		
			function push_pl(text){
				
				jQuery.ajax({
					url:"push_pl.php",
					type:"post",
					async:true,
					data:{
						weibo_id:<?php echo $wbid?>,
						ptext:text						
					},
					dataType:'text',
					success:function(data){
						$("#btn").remove();
						//$("#pl_inp").remove();
						$("#pl_inp").after("评论"+data);
						//0.5秒后刷新页面
						setTimeout("location.reload()",200);
					},
					error:function(data){
						$("#btn").after("<b>评论"+data+"</b>");
					}
				});
				
				
				
				
			}
			
			
		
		</script>
	</body>
</html>