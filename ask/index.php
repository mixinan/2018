<?php
	 $wbid=53;

     #1.数据库连接
	 require("../things/init.php"); 
	 #2.拼sql语句
	 #$sql_wb="select * from weibo where weibo_id=$wbid";
	 $sql_pl="select * from wbpinglun where weibo_id=$wbid order by pid desc";
	 $sql_last_plid="select * from wbpinglun where weibo_id=$wbid order by pid desc limit 1";
	 
	 #echo $sql_last_plid;
	 
	 #3.执行查询，并得到结果
     
	 $result=mysqli_query($conn,$sql_pl);
	 $row=mysqli_query($conn,$sql_last_plid);
	 
	 #echo $last_plid;
	 
	 #$result_wb=mysqli_query($conn,$sql_wb);
	 
	 $array=mysqli_fetch_all($result,MYSQLI_ASSOC);
	 $row=mysqli_fetch_row($row);
	 
	 #var_dump($row);
	 #echo "<pre>";
	 #print_r($row);
	 #echo "</pre>";
	 
	 #$weibo = "<h4>$row[1]</h4><div class='weibo_info'>第<b>$row[0]</b>条  <span class='ptime'>$row[2]</span> 评论($row[4])</div><br> ";
	 $pinglun = json_encode($array); 
	 $last_plid=$row[0];
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>放假倒计时</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link rel="shortcut icon" href="../img/guo3.ico" type="image/x-icon">
	<script src="../things/jquery-1.11.3.js"></script>
	<script src="../things/common.js"></script>
    <style>
		body,p{padding:0;margin:0;}
        #container{width: 100%; text-align: center; margin: 10px auto 30px;}
		h3{font-size:50px;}
		p{font-size:23px;}
		#ms{width: 55px; display: inline-block; text-align: center;}
		#pl_layout{width:80%; margin: 0 auto; text-align:center;}
		#new_pl{
			text-align:center;
			font-size:1rem;
			position:fixed;
			top:0;
			width:100%;
			background:#C6EC50;
		}
		#new_pl>a{
			text-decoration:none;
		}
    </style>
    <script>
        window.onload=function(){
			
            var tvResult = document.getElementById('tv');
            var tvTime = document.querySelector("#container>h3>span");
			var tvMs = document.getElementById('ms');

            var targetTimeString = "2018/04/28 17:30:00";
            tvTime.innerHTML = targetTimeString;
            var targetTime = (new Date(targetTimeString)).getTime();

            var perSecond = 1000;
            var perMinute = 60*perSecond;
            var perHour = 60*perMinute;
            var perDay = 24*perHour;

            var d, h, m, s, result;
			

			/*
				计算当前时间与目标时间的差距
				以 x天 x时 x分 x秒 x毫秒 的形式显示
			*/
            function go(){
                result = jueduizhi(targetTime - new Date().getTime());

                d = parseInt(result/perDay);
                h = parseInt((result-d*perDay)/perHour);
                m = parseInt((result-d*perDay-h*perHour)/perMinute);
                s = parseInt((result-d*perDay-h*perHour-m*perMinute)/perSecond);
				ms = parseInt((result-d*perDay-h*perHour-m*perMinute-s*perSecond)%1000);

                tvResult.innerHTML = '<b>'+betwo(d)+'</b> 天 <b>'+betwo(h)+'</b> 小时 <b>'+betwo(m)+'</b> 分 <b>'+betwo(s)+'</b> 秒 <b id="ms"> '+ms+' </b>  毫秒';
            }

			
            /*取绝对值*/
            function jueduizhi(a){
                if(a>=0){
                    return a;
                }else{
                    return -a;
                }
            }
			
			
			/*如果是一位数字，前面补0，变为两位*/
			function betwo(n){
				if(n<10){
					n="0"+n;
				}
				return n;
			}
			

			/*每12毫秒执行一次go()函数*/
            setInterval(go,12);
        }
    </script>
</head>
<body>
	<!--新评论的布局-->
	<p id="new_pl">
		<a href="javascript:window.location.reload()">有新评论,点击可以刷新查看</a>
	</p>
    
	<div id="container">
        <h3>距离 <span></span></h3> <hr/>
        <p id="tv">
            正在加载...
        </p>
		<hr>
    </div>
	
	<div id="pl_layout">
		<p class="pl_box">
			<input id="pl_inp" placeholder="评论一下吧"/>
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
			$("#new_pl").hide();
		
			var init_last_plid=<?php echo $last_plid;?>;
			var last_plid=0;
			
			
			console.log("init_last_plid: "+init_last_plid);
		
			setInterval(getlastplid,5000);
			
			
			function getlastplid(){
				jQuery.ajax({
					url:"../things/lastplid.php",
					type:"get",
					async:true,
					dataType:'text',
					success:function(data){
						console.log(data);
						last_plid = data;
						if(last_plid > init_last_plid){
								//说明有新评论
								$("#new_pl").slideDown(1000);
								
						}
					},
					error:function(data){
						
					}
				});
			}
		
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
		
		
		
			//提交评论到数据库
			function push_pl(text){
				
				jQuery.ajax({
					url:"../things/push_pl.php",
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
						//$("#pl_inp").after("评论"+data);
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