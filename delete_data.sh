#!/bin/bash
# helper function called by dalete_dataset.php
id=$2
dir=$1
count=0
stop=$2
for d in $(find $dir/* -maxdepth 0 -type d)
do  ((count++))
    if [ $count -eq $stop ]
    then
    rm -rf $d
    fi
done
