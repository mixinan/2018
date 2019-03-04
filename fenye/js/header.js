$(()=>{//加载页头
	
	//先判断有没有登录
	/*if(location.pathname.endsWith("cart.html")){
		$.get("data/users/isLogin.php")
			.then(data=>{
			if(data.ok==0){
				alert("请先登录!");
				location="login.html";
			}
		})
	}*/


	$("#header").load("header.html")
});