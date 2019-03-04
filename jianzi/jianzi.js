$(function(){
    getUserList();
});

var name ="";

$("#uname").bind('input propertychange', function() {
    name = $("#uname").val();
    if(name.length > 1){
        $("#bt").removeAttr("disabled");
    }else{
        $("#bt").attr("disabled",true);
    }

});


$("#bt").click(function(){
    name = $("#uname").val();
    if(isnull(name)){
        alert("请检查你的输入！");
        $("#uname").val("");
        return;
    }
    addUser(name);
});

/*
 * 获取名单列表
 * */
function getUserList(){
    $.ajax({
        url:"user/list",
        type:"get",
        async:true,
        dataType:'json',
        success:function(data){
            console.log("得到%d个用户名字",data.length);
            if(data.length>=1){
                var html = "<table border='1' cellpadding='3' cellspacing='0'>";

                for(n in data){
                    if(n%5 == 0){
                        html += "<tr>";
                    }

                    var xuhao = parseInt(n)+1;

                    html += `<td> ${xuhao}  ${data[n].uname} </td>`;

                    if(n%5 == 4){
                        html += "</tr>";
                    }
                }

                html += "</table>";

                $("#users").html(html);
            }else{
                $("#users").html("还没有人报名...");
            }
        },
        error:function(data){
            alert("出现错误！");
        }
    });
}



/*
 * 添加用户到数据库
 * */
function addUser(str){
    $.ajax({
        url:"user/add.do",
        type:"get",
        async:true,
        data:{uname:str},
        dataType:'text',
        success:function(data){
            if(data=="ok"){
                $("#baoming").html("报名成功");
                $("#baoming").hide(1500);
                getUserList();
            }else{
                alert("报名失败！");
            }
        },
        error:function(data){
            alert("出现错误！");
        }
    });
}


/*
 * 判断输入是否为空
 * */
function isnull(val) {
    var str = val.replace(/(^\s*)|(\s*$)/g, '');
    if (str == '' || str == undefined || str == null) {
        return true;
    } else {
        return false;
    }
}