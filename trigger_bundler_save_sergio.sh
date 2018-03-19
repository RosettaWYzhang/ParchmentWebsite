#!/bin/bash
    cd /services/Parchment/bundler_sfm/
    echo IMAGE_DIR=/var/www/parchmentwebsite/uploads/$1/$2/ >> config$2.txt
    echo MATCH_WINDOW_RADIUS=\"-1\" >> config$2.txt
    echo FOCAL_WEIGHT=\"0.0001\" >> config$2.txt
    echo RAY_ANGLE_THRESHOLD=\"2.0\" >> config$2.txt
    echo INIT_FOCAL=10000 >> config$2.txt
    (mogrify -resize 50% /var/www/parchmentwebsite/uploads/$1/$2/*.jpg; mogrify -resize 50% /var/www/parchmentwebsite/uploads/$1/$2/*.png; sh bundler.sh config$2.txt /var/www/parchmentwebsite/output/bundler/$2/; zip $2.zip /var/www/parchmentwebsite/output/bundler/$2/bundle; mkdir -p /var/www/parchmentwebsite/downloads/$1;chmod -R 777 /var/www/parchmentwebsite/downloads/$1;mv $2.zip /var/www/parchmentwebsite/downloads/$1/; echo "Please go to our services page to download the flattened parchment." | mail -s "Your dataset is available" wanyue.zhang.16@ucl.ac.uk) &

