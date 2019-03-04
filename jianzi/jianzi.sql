SET NAMES UTF8;

DROP DATABASE IF EXISTS jianzi;

CREATE DATABASE jianzi CHARSET=UTF8;

USE jianzi;

create table user(
    uid int primary key auto_increment,
    uname varchar(32),
    u_createtime datetime
);


insert into user values
(null,'群主',now()),
(null,'孙总',now()),
(null,'刘工',now()),
(null,'开心每一天',now()),
(null,'方姐',now()),
(null,'雨汐',now()),
(null,'云',now()),
(null,'亮点',now()),
(null,'随遇而安',now()),
(null,'洁雪冰心',now()),
(null,'懒洋洋',now()),
(null,'放心人',now()),
(null,'静夜思',now()),
(null,'天天开心',now()),
(null,'星哥',now()),
(null,'坤哥',now()),
(null,'小顽童',now()),
(null,'虎哥',now()),
(null,'小徐',now()),
(null,'盛世金陵',now()),
(null,'娟',now()),
(null,'身在尘世',now()),
(null,'知足常乐黄芳',now()),
(null,'远方有爱',now()),
(null,'小雨',now()),
(null,'小陵姐',now()),
(null,'戴工',now()),
(null,'龙卷风',now()),
(null,'葛兆喜',now()),
(null,'小刘鑫',now()),
(null,'小刘鑫家长',now()),
(null,'万码千钧',now()),
(null,'阿红',now()),
(null,'小陆',now()),
(null,'景明和煦',now()),
(null,'于爱洋',now()),
(null,'豪放',now()),
(null,'月月',now()),
(null,'毽子达人',now()),
(null,'羽王',now()),
(null,'大吕',now()),
(null,'杨琳',now()),
(null,'陈小红',now()),
(null,'刘祥',now()),
(null,'紫荆',now()),
(null,'郎吉祥',now()),
(null,'王姐',now()),
(null,'黄东平',now()),
(null,'张姐',now()),
(null,'杨姐',now()),
(null,'琴声悠扬',now()),
(null,'琴妹',now()),
(null,'何季培',now()),
(null,'刘力志',now()),
(null,'小刘鑫师姐',now()),
(null,'小刘鑫师姐家长',now()),
(null,'西宁',now()),
(null,'骑士',now()),
(null,'琴姐',now());


create table jiemu(
jid int primary key auto_increment,
jname varchar(128),
j_createtime datetime
);

insert into jiemu values
(null,'歌曲《花房姑娘》',now()),
(null,'Test',now());

select * from jiemu;


