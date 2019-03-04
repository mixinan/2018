$(function(){
    getJiemuList();
});

var jname ="";

$("#jname").bind('input propertychange', function() {
    jname = $("#jname").val();
    if(jname.length > 1){
        $("#bt2").removeAttr("disabled");
    }else{
        $("#bt2").attr("disabled",true);
    }

});


$("#bt2").click(function(){
    jname = $("#jname").val();
    if(isnull(jname)){
        alert("请检查你的输入！");
        $("#jname").val("");
        return;
    }
    addJiemu(jname);
});

/*
 * 获取名单列表
 * */
function getJiemuList(){
    $.ajax({
        url:"jiemu/list",
        type:"get",
        async:true,
        dataType:'json',
        success:function(data){
            console.log("得到%d个节目名字",data.length);
            if(data.length>=1){
                var html = "<table border='1' cellpadding='3' cellspacing='0'>";

                for(n in data){
                    if(n%4 == 0){
                        html += "<tr>";
                    }

                    var xuhao = parseInt(n)+1;

                    html += `<td> ${xuhao}  ${data[n].jname} </td>`;

                    if(n%4 == 3){
                        html += "</tr>";
                    }
                }

                html += "</table>";

                $("#jiemus").html(html);
            }else{
                $("#jiemus").html("还没有人报节目...");
            }
        },
        error:function(data){
            alert("出现错误！");
        }
    });
}



/*
 * 添加节目到数据库
 * */
function addJiemu(str){
    $.ajax({
        url:"jiemu/add.do",
        type:"get",
        async:true,
        data:{jname:str},
        dataType:'text',
        success:function(data){
            if(data=="ok"){
                $("#baojiemu").html("报节目成功");
                $("#baojiemu").hide(1500);
                $("#jiemu-title").hide(1500);
                getJiemuList();
            }else{
                alert("报节目失败！");
            }
        },
        error:function(data){
            alert("出现错误！");
        }
    });
}

