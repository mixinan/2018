/*
	加载最近10条
*/
/*
$(()=>{
	$.ajax({
		type:"get",
		url:"data/index/getTop10.php",
		dataType:"json"
	}).then(data=>{
		for(var i=0,html="";i<data.length;i++){
			var p=data[i];
			html+=`<li> 
					<p class="details">${p.weibo_id}. ${p.weibo_text}</p>
				</li>`;
		}
		document.querySelector("div.container>ul.list")
			.innerHTML=html;
	});

});
*/



/*
	加载第几页
	默认第一页
*/
function load(pno=1){
	var kw;//undefined
	if(location.search!=="")//?kw=mac i7 256g
		kw=location.search.slice(1);
	$.ajax({
		type:"get",
		url:"data/index/getWeibosByKw.php",
		data:"pno="+pno+(kw?"&"+kw:""),//三目运算
		dataType:"json"
	}).then(output=>{
		var {data,pno,pcount}=output;
		var html="";
		for(var p of data){
			html+=`<li>
				<p>
					${p.weibo_id}. ${p.weibo_text}<br><br>
					<span>${p.weibo_create_time}</span>
				</p>
			</li>`;
		}
		document.querySelector("div.container>ul.list")
			.innerHTML=html;
			
			
		

			
			
		/*
			页码框部分的代码
			
		*/
		var html=`<a href="javascript:;" class="previous">上一页</a>`;
		for(var i=1;i<=pcount;i++){
			html+=`<a href="javascript:;" class=${i==pno?"current":""}>${i}</a>`;
		}
		html+=`<a href="javascript:;" class="next">下一页</a>`;

		//页码框的div容器
		var pages=document.getElementsByClassName("pages");
		
		////
		var i;
		for (i = 0; i < pages.length; i++) {
			divPages=pages[i];
			divPages.innerHTML=html;
			
			var prev=divPages.children[0],
			next=divPages.lastElementChild;
		
			if(pno==1) prev.className="previous disabled";
			else prev.className="previous";

			if(pno==pcount) next.className="next disabled";
			else next.className="next";
		}
		
		////
		/*
		divPages.innerHTML=html;
		
		var prev=divPages.children[0],
			next=divPages.lastElementChild;
		
		if(pno==1) prev.className="previous disabled";
		else prev.className="previous";

		if(pno==pcount) next.className="next disabled";
		else next.className="next";*/
	})
}





//
//页面一加载的时候执行
//
$(()=>{
	
	load();

	//点击页码框，事件绑定到容器
	document.getElementsByClassName("pages")[0].onclick=function(e){
		if(e.target.nodeName=="A"){
			var a=e.target;
			//当 按钮不可用 或者 是当前页按钮，则什么都不做
			if(!/disabled|current/.test(a.className)){
				if(/previous|next/.test(a.className)){
					var i=parseInt(
						document.querySelector(".pages:first-child>.current").innerHTML
					);
					if(a.className=="previous"){
						load(i-1);
					}else{
						load(i+1);	
					}
				}else{
					//点击第几页，就加载第几页的数据
					load(a.innerHTML);
				}
				$("html,body").animate({scrollTop:0},"slow");
			}
		}
	}
	
	
	document.getElementsByClassName("pages")[1].onclick=function(e){
		if(e.target.nodeName=="A"){
			var a=e.target;
			//当 按钮不可用 或者 是当前页按钮，则什么都不做
			if(!/disabled|current/.test(a.className)){
				if(/previous|next/.test(a.className)){
					var i=parseInt(
						document.querySelector(".pages:last-child>.current").innerHTML
					);
					if(a.className=="previous"){
						load(i-1);
					}else{
						load(i+1);	
					}
				}else{
					//点击第几页，就加载第几页的数据
					load(a.innerHTML);
				}
				$("html,body").animate({scrollTop:0},"slow");
			}
		}
	}
	
	
});