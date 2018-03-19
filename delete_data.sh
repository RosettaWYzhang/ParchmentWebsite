#!/bin/bash
echo "entered delete.data.sh" >> debug.txt
id=$2
dir=$1
echo "print dir again" >> debug.txt
echo $dir >> debug.txt
count=0
stop=$2
for d in $(find $dir/* -maxdepth 0 -type d)
do  ((count++))
    if [ $count -eq $stop ]
    then
    echo $d >> debug.txt
    rm -rf $d
    fi
done
