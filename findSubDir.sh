#!/bin/bash
# helper script called by callBundlerWithDataset.php to determine which dataset is sellected by user
count=0
stop=$1
for d in $(find * -maxdepth 0 -type d)
do  ((count++))
    if [ $count -eq $stop ]
    then
    echo $d
    fi
done
