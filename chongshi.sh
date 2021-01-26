#!/bin/sh

count=0     #记录重试次数
flag=1      # 重试标识，flag=0 表示任务正常，flag=1 表示需要进行重试
while [ 0 -eq 0 ]
do
    echo ".................. job begin  ..................."
    echo $flag;
    # ...... 添加要执行的内容，flag 的值在这个逻辑中更改为1，或者不变......
    sudo docker-compose build && flag=0;
    # 检查和重试过程   
    if [ $flag -eq 0 ]; 
    then     #执行成功，不重试
        echo "--------------- job complete ---------------"
        break;
    else                        #执行失败，重试
        count=$[${count}+1]
        if [ ${count} -eq 6 ]; then     #指定重试次数，重试超过5次即失败
            echo 'timeout,exit.'
            break
        fi
        echo "...............retry in 2 seconds .........."
        sleep 2
    fi
done