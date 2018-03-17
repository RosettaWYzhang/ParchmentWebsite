    cd /services/Parchment/bundler_sfm/
    echo IMAGE_DIR=/var/www/parchmentwebsite/uploads/$2/$1/ >> config$1.txt
    echo MATCH_WINDOW_RADIUS=\"-1\" >> config$1.txt
    echo FOCAL_WEIGHT=\"0.0001\" >> config$1.txt
    echo RAY_ANGLE_THRESHOLD=\"2.0\" >> config$1.txt
    echo INIT_FOCAL=10000 >> config$1.txt
    (mogrify -resize 50% /var/www/parchmentwebsite/uploads/$2/$1/*.jpg; mogrify -resize 50% /var/www/parchmentwebsite/uploads/$2/$1/*.png; sh bundler.sh config$1.txt /var/www/parchmentwebsite/output/bundler/$1/; php bundlerOutput.php -- $1) &
