#!/bin/bash
echo "in zip.sh" >> /var/www/parchmentwebsite/debug.txt
echo "zipping path" >> /var/www/parchmentwebsite/debug.txt
echo $1 >> /var/www/parchmentwebsite/debug.txt
cd $1
echo "print current working directory" >> /var/www/parchmentwebsite/debug.txt
echo $PWD >> /var/www/parchmentwebsite/debug.txt
zip result.zip $2

if [ -2 result.zip ]
then
echo "in bash zipping successful" >> /var/www/parchmentwebsite/debug.txt
else
echo "in bash zipping not successful" >> /var/www/parchmentwebsite/debug.txt
fi

mv result.zip /var/www/parchmentwebsite/downloads/
