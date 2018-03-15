count=-1
stop=$1
for d in $(find * -maxdepth 0 -type d)
do  ((count++))
    if [ $count -eq $stop ]
    then
    #echo $count
    echo $d
    #return $d
    fi
done
