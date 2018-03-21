#!/bin/bash

# create a unique config file for every dataset before calling bundler
cd /services/Parchment/bundler_sfm/
echo IMAGE_DIR=/var/www/parchmentwebsite/uploads/$1/$2/ >> config$2.txt
echo MATCH_WINDOW_RADIUS=\"-1\" >> config$2.txt
echo FOCAL_WEIGHT=\"0.0001\" >> config$2.txt
echo RAY_ANGLE_THRESHOLD=\"2.0\" >> config$2.txt
echo INIT_FOCAL=10000 >> config$2.txt

# background process to run bundler
(mogrify -resize 50% /var/www/parchmentwebsite/uploads/$1/$2/*.jpg; mogrify -resize 50% /var/www/parchmentwebsite/uploads/$1/$2/*.png; sh bundler.sh config$2.txt /var/www/parchmentwebsite/output/bundler/$2/; mkdir -p /var/www/parchmentwebsite/downloads/$1/$2; chmod -R 777 /var/www/parchmentwebsite/downloads/$1/$2; mv /var/www/parchmentwebsite/output/bundler/$2/bundle /var/www/parchmentwebsite/downloads/$1/$2; currentDate=$(date);echo "Processing of your dataset $2 is completed on $currentDate. Please go to our services page to download the flattened parchment. Quote your dataset ID $2 when downloading the dataset." | mail -s "Your dataset is available" $1) &
# send user email with unique ID and completion time once processing is complete
