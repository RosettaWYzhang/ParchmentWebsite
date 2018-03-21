#!/bin/bash
#helper script used by confirm.php to move files to target directory
target_user=$1
target_dir=$2
mv $target_user/*.jpg $target_dir/
