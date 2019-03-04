const express = require("express");
var router = express.Router();

router.get("/list",(req,res)=>{
    res.send("goods list");
});

router.use("/del",(req,res,next)=>{
    var type = req.query.type;
    if(type==9){
        next();
    }else{
        res.send("<h1>����Ȩ�޲��㣬����ϵ����Ա</h1>");
    }
});

router.get("/del",(req,res)=>{
    res.send("goods del");
});

router.get("/update",(req,res)=>{
    res.send("goods update");
});

router.get("/search",(req,res)=>{
    res.send("goods search");
});

module.exports = router;