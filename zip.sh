#!/bin/bash
# helper script called by download.php to zip processed dataset
# $1 is the zipping pathl $2 is dataset ID
cd $1
echo $PWD >> debug.txt
zip -r result.zip $2
if [ ! -f result.zip ];
then
  echo "in bash zipping not successful" >> /var/www/parchmentwebsite/debug.txt
fi
mv result.zip /var/www/parchmentwebsite/downloads/
