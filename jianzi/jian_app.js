const http = require("http");
const express = require("express");
const routerUser = require("./router/user");
const routerGoogs = require("./router/goods");
const routerJiemu = require("./router/jiemu");

var app = express();

var server = http.createServer(app);

app.use(express.static("public"));

server.listen(3000);

app.get("/",(req,res)=>{
    res.sendFile(__dirname+"/index.html");
});

app.get("/jquery.js",(req,res)=>{
    res.sendFile(__dirname+"/jquery.js");
});
app.get("/jianzi.js",(req,res)=>{
    res.sendFile(__dirname+"/jianzi.js");
});
app.get("/jiemu.js",(req,res)=>{
    res.sendFile(__dirname+"/jiemu.js");
});

app.use("/user",routerUser);
app.use("/goods",routerGoogs);
app.use("/jiemu",routerJiemu);