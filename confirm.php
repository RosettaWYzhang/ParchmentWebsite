<?php
session_start();
ini_set('display_errors',1);
$foldername = $_SESSION['username'];
$id = uniqid (rand(), true);
$target_user = "uploads/" . $foldername;
$target_dir = "uploads/" . $foldername ."/" .$id;
$fileNum=shell_exec("ls -1q *.jpg | wc -l");
if($fileNum==0){
  header('Location: services.php');
  exit;
}
if( is_dir($target_dir) === false ) // Should always be false, as it is a unique id
{
    echo "    Creating dir   ";
    // give full permision
    $oldmask = umask(0);
    mkdir($target_dir, 0777);
    umask($oldmask);
}
shell_exec("sh moveFile.sh $target_user $target_dir");
header('Location: services.php');
?>
