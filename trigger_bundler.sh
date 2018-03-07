    cd /services/Parchment/bundler_sfm/
    echo IMAGE_DIR=/var/www/parchmentwebsite/uploads/$1/ >> config$1.txt
    echo LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/services/Parchment/bundler_sfm/bin >> config$1.txt
    echo PATH=$PATH:/services/Parchment/bundler_sfm/bin >> config$1.txt
    echo MATCH_WINDOW_RADIUS="-1" >> config$1.txt
    echo FOCAL_WEIGHT="0.0001" >> config$1.txt
    echo RAY_ANGLE_THRESHOLD="2.0" >> config$1.txt
    echo INIT_FOCAL=10000 >> config$1.txt
    (mogrify -resize 50% /var/www/parchmentwebsite/uploads/$1/*.jpg; mogrify -resize 50% /var/www/parchmentwebsite/uploads/$1/*.png; export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/services/Parchment/bundler_sfm/bin; export PATH=$PATH:/services/Parchment/bundler_sfm/bin; ./RunBundler.sh config$1.txt; php bundlerOutput.php -- $1) &
