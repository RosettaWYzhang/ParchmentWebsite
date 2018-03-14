target_user=$1
target_dir=$2
mv $target_user/*.jpg $target_dir/
touch debug.txt
echo "hello world" >> debug.txt
echo $target_user >> debug.txt
echo $target_dir >> debug.txt
