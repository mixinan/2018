const express = require("express");
const http = require("http");
const bodyParser = require("body-parser");
const mysql = require("mysql");
var router = express.Router();

var app = express();

app.use(bodyParser.urlencoded({extended:false}));

var pool = mysql.createPool({
    host:"127.0.0.1",
    user:"root",
    password:"mixinan007!",
    database:"jianzi",
    port:3306,
    connectionLimit:5
});

router.all("/add.do",(req,res)=>{
    var name = req.query.uname;
    //console.log(name);
    //console.log(req.path);

    var sql = "insert into user values(null,?,now())";

    pool.query(sql,[name],(err,result)=>{
        if(err) throw err;
        if(result.affectedRows>0){
            console.log("user insert ok!");
             //console.log(__dirname);
             //var i = __dirname.lastIndexOf("\\");
             //console.log(i);
             //var path = __dirname.substring(0,i);
             //console.log(path+"/index.html");
             //res.sendFile(path+"/index.html");
             res.send("ok");
        }
    });

});

router.get("/list",(req,res)=>{
    var sql = "select * from user";
    pool.query(sql,(err,result)=>{
        if(err) throw err;
        res.json(result);
    });
});

router.use("/del",(req,res,next)=>{
    var type = req.query.type;
    if(type==9){
        next();
    }else{
        res.send("<h1>您的权限不足，请联系管理员</h1>");
    }
});

router.get("/del",(req,res)=>{
    res.send("user del");
});

router.get("/update",(req,res)=>{
    res.send("user update");
});

router.get("/search",(req,res)=>{
    res.send("user search");
});

module.exports = router;