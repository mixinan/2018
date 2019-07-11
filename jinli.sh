#!/bin/bash

# 存储已抽名单的文本文件
pass="pass.txt"

getName(){
case $1 in
1)	echo -n "耿玉雪";;
2)	echo -n "张林";;
3)	echo -n "郭鱼";;
4)	echo -n "祝锦";;
5)	echo -n "李承诺";;
6)	echo -n "何明宏";;
7)	echo -n "唐俊杰";;
8)	echo -n "施文杰";;
9)	echo -n "余彪";;
10)	echo -n "蒋文明";;
11)	echo -n "潘旺";;
12)	echo -n "王柳";;
esac
}


showAndSaveResult(){
	echo "========================="
	sleep 0.1
	echo "========================="
	sleep 0.1
	echo "========================="
	sleep 0.1
	echo "========================="
	sleep 0.1
	echo "========"
	sleep 0.1
	echo "======="
	sleep 0.1
	echo "======"
	sleep 0.1
	echo "====="
	sleep 0.1
	echo "===="
	echo -n "==="
	sleep 0.2
	echo -n " 恭"
	sleep 0.2
	echo -n "喜"
	sleep 1
	echo -n  " $1 " 
	sleep 0.3
	echo -n "号"
	sleep 0.2
	echo -n "学"
	sleep 0.2
	echo -n "员"
	sleep 0.2
	echo -n "："
	sleep 0.8
	getName $1
	sleep 1
	echo $1 >> $pass
	sleep 0.2
	echo
	echo -n "==="
	sleep 0.2
	echo -n " 你"
	sleep 0.1
	echo -n "是"
	sleep 0.1
	echo -n "本"
	sleep 0.1
	echo -n "轮"
	sleep 0.1
	echo -n "抽"
	sleep 0.1
	echo -n "取"
	sleep 0.1
	echo -n "的"
	sleep 0.1
	echo -n "第 "
	sleep 0.3
	echo -n "`cat $pass | wc -l` "
	sleep 0.3
	echo  "人 "
	sleep 0.1
	echo "=========================="
	sleep 0.1
	echo "=========================="
	sleep 0.1
	echo "=========================="
	sleep 0.1
	echo "=========================="
	sleep 0.1
	echo "=========================="
	sleep 0.1
	echo "=========================="
	sleep 0.1
	echo "=========================="
	sleep 0.1
	echo "=========================="
}



# 查询并显示已经抽过的人数
# touch 这一步，可以避免文件不存在
touch $pass
length=`cat $pass | wc -l`

# 如果已经抽满12人，重置数据库
if [ $length -eq 12 ];then
	echo "================="
	sleep 0.3
	echo "================="	
	sleep 0.3
	echo "================="	
	echo  "第一轮已全部抽完,"
	sleep 0.3
	echo  "请重新抽取第二轮!"
	echo "================="	
	sleep 0.3
	echo "================="	
	sleep 0.3
	echo "================="	
	> $pass
	exit
fi

# 如果是第一次抽奖
if [ $length -eq 0 ];then
	jinli=$[RANDOM%12+1]
	showAndSaveResult $jinli
	exit
fi

flag=0

while :
do

jinli=$[RANDOM%12+1]

for n in `cat $pass`
do
	if [ $jinli -eq $n ];then
		flag=1
		break
	fi
done

if [ $flag -eq 1 ];then
	flag=0
	continue
else
	showAndSaveResult $jinli
	exit
fi


done
