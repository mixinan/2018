<?php
//data/products/getWeibosByKw.php
header("Content-Type:application/json");
require_once("../init.php");

//基础sql语句，需要在后面拼接 限定语句
$sql="SELECT weibo_id, weibo_text, weibo_create_time, pinglun_num FROM `weibo` order by weibo_id desc ";

//获取关键字 字符串
@$kw=$_REQUEST["kw"];

//处理关键字的字符串
//kw="mac 256g i7"
if($kw!=null){
	$kws=explode(" ",$kw);//kws=kw.split(" ")
	//kws[mac, 256g, i7]
	for($i=0;$i<count($kws);$i++){
		$kws[$i]=" weibo_text like '%$kws[$i]%' ";
	}

	//kws[weibo_text like '%mac%', weibo_text like '%256g%', ...]
	
	$where=implode(" and ",$kws);//kws.join(" and ")

	//处理后的字符串
	//"weibo_text like '%mac%' and weibo_text like '%256g%' and weibo_text like '%i7%'"

	//追加到sql语句后面
	$sql.=" where $where ";
}


//不加分页功能时的查询结果
$result=mysqli_query($conn,$sql);
$rows=mysqli_fetch_all($result,1);



//
//添加分页功能
//


//第几页
@$pno=$_REQUEST["pno"];
//默认第一页
if($pno==null) $pno=1;


//每页显示的条数
@$psize=$_REQUEST["psize"];
//默认为10
if($psize==null) $psize=10;


//查询到的总条数（根据未分页时的结果计算）
$count=count($rows);


//拼接最终的sql语句
$sql.=" limit ".(($pno-1)*$psize).",$psize";

$result=mysqli_query($conn,$sql);
$rows=mysqli_fetch_all($result,1);

$output=[
	"pno"=>$pno,
	"psize"=>$psize,
	"count"=>$count, //查询到的总条数
	"pcount"=>ceil($count/$psize),//需要显示的最大页码
	"data"=>$rows //当前页的查询结果
];

echo json_encode($output);