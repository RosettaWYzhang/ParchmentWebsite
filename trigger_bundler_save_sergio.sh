#!/bin/bash
    echo "entered trigger bundler" >> debug.txt
    echo "print $1 username" >> debug.txt
    echo $1 >> debug.txt
    echo "print $2 unique id" >> debug.txt
    echo $2 >> debug.txt
    cd /services/Parchment/bundler_sfm/
    echo IMAGE_DIR=/var/www/parchmentwebsite/uploads/$1/$2/ >> config$2.txt
    echo MATCH_WINDOW_RADIUS=\"-1\" >> config$2.txt
    echo FOCAL_WEIGHT=\"0.0001\" >> config$2.txt
    echo RAY_ANGLE_THRESHOLD=\"2.0\" >> config$2.txt
    echo INIT_FOCAL=10000 >> config$2.txt
    (mogrify -resize 50% /var/www/parchmentwebsite/uploads/$1/$2/*.jpg; mogrify -resize 50% /var/www/parchmentwebsite/uploads/$1/$2/*.png; sh bundler.sh config$2.txt /var/www/parchmentwebsite/output/bundler/$2/; php bundlerOutput.php -- $2) &
