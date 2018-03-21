#!/bin/bash
# helper script called by download.php to zip processed dataset
cd $1
zip result.zip $2
if [ -2 result.zip ]
then
  echo "in bash zipping successful" >> /var/www/parchmentwebsite/debug.txt
else
  echo "in bash zipping not successful" >> /var/www/parchmentwebsite/debug.txt
fi
mv result.zip /var/www/parchmentwebsite/downloads/
