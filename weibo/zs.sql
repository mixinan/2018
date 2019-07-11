SET  NAMES  UTF8;

DROP DATABASE IF EXISTS zhishi;

CREATE DATABASE zhishi  CHARSET=UTF8;

USE zhishi;


CREATE TABLE weibo(
  weibo_id INT primary key auto_increment,
  weibo_text varchar(1024),
  weibo_create_time DATETIME default now(),
  weibo_last_modify_time DATETIME default now(),
  pinglun_num int default 0
);

INSERT INTO weibo (weibo_text) VALUES("test1");
INSERT INTO weibo (weibo_text) VALUES("test2");
INSERT INTO weibo (weibo_text) VALUES("test3");
INSERT INTO weibo (weibo_text) VALUES("test4");
INSERT INTO weibo (weibo_text) VALUES("test5");





create table wbpinglun(
	pid int primary key auto_increment,
	ptext varchar(200) not null,
	pcreate_time DATETIME default now(),
	weibo_id int
);


insert into wbpinglun (ptext,weibo_id) values("are you ok?",2);
insert into wbpinglun (ptext,weibo_id) values("111111111",1);
insert into wbpinglun (ptext,weibo_id) values("222222222",1);
insert into wbpinglun (ptext,weibo_id) values("I am michael!",1);



update weibo set pinglun_num=pinglun_num+3 where weibo_id=1;
update weibo set weibo_last_modify_time=now() where weibo_id=1;
update weibo set pinglun_num=pinglun_num+1 where weibo_id=2;
update weibo set weibo_last_modify_time=now() where weibo_id=2;

select * from weibo;

select * from wbpinglun;






select wb.weibo_id,wb.weibo_text,wb.weibo_create_time,pl.ptext from weibo wb,wbpinglun pl where wb.weibo_id=pl.weibo_id;





#评论页面(根据weibo_id)
select wb.weibo_id,wb.weibo_text,wb.weibo_create_time,pl.ptext from weibo wb,wbpinglun pl where wb.weibo_id=pl.weibo_id;

