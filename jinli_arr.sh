#!/bin/bash
# 存储班级号码的文本文件，便于下次自动读取
# 理论上，在一个班级，只需要在第一次输班级名，之后不用输入
classf="class.txt"
touch $classf

if [ ! -s $classf ];then
	# 输入班级号码
	read -p "请输入班级号码(4位数字)：" classn
	echo $classn > $classf
fi

class=`cat $classf`

# 存储了所有人名单的文本文件
names="nsd${class}_names.txt"
# 存储了所有已抽取名单的文本文件
pass="nsd${class}_pass.txt"
# 防止文件不存在
touch $pass $names

# 初始化数组
arr=()
# 给数组赋值的下标，在循环里自增
i=0

# 给数组赋值
for data in `cat $names`
do
	arr[$i]=$data
	let i++
done

# 循环显示一波数据
for a in ${arr[*]}
do
	echo  "$a"
	sleep  0.1
	# clear
done
echo "================="
echo

# ===========初始化工作完成==============

# 记录整个数组的长度
length=${#arr[*]}

# 记录目前已抽到的人数
num=`cat $pass | wc -l`

# 第一次抽的情况 num==0
# 已经抽完了的情况 num==length
if [ $num -eq 0 ];then
	rand=$[RANDOM%length]
	echo ${arr[rand]} >> $pass
	cat $pass
	echo
	exit
elif [ $num -eq $length ];then
	echo
	echo "没有人可抽取了"
	sleep 1
	echo "已抽完一轮，名单顺序如下："
	echo
	cat $pass
	> $pass
	echo "=================="
	echo "请重新抽取！"
	echo
	exit
fi


# 标志位，用来表示是否已被抽到过，0表示未抽到过，1表示抽到过
flag=0

# 死循环
# 如果已被抽过，则重新抽选，直到抽出不重复的，循环结束
while :
do
	rand=$[RANDOM%length]
	name=`echo ${arr[rand]}`

	# 挨个儿比较一轮，看名单里是否出现过
	# 一旦出现过，更改标志位，然后重新抽取。否则，显示并记录结果
	for a in `cat $pass`
	do
		if [ $a = $name ];then
			flag=1
			break
		fi
	done
	
	if [ $flag -eq 1 ];then
		flag=0
		continue
	else
		echo $name >> $pass
		cat $pass 
		sleep 1
		echo -n "↑"
		sleep 0.3
		echo -n "↑"
		sleep 0.3
		echo -n "↑"
		sleep 0.3
		echo -n "↑"
		sleep 0.3
		echo -n "↑"
		sleep 0.3
		echo -n "恭喜"
		sleep 0.3
		echo
		sleep 0.2
		echo
		sleep 0.2
		echo
		sleep 0.2
		echo
		sleep 0.2
		echo
		sleep 0.3
		exit
	fi
done
