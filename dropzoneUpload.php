<?php
ini_set('display_errors', 1);
session_start();

//default: user wants to upload images
$request = 1;
//request == 2 means that the user wants to delete the image
if(isset($_POST['request'])){ 
  $request = $_POST['request'];
}

$foldername = $_SESSION['username'];
$target_dir = "uploads/" . $foldername ."/";
$_SESSION['target_dir'] = $target_dir;

if($request == 1){
if( is_dir($target_dir) === false ) 
{
    echo "    Creating dir   ";
    // give full permision
    $oldmask = umask(0);
    mkdir($target_dir, 0777);
    umask($oldmask);
}

if (!empty($_FILES)) 
{ 
     $tempFile = $_FILES['file']['tmp_name'];//this is temporary server location

     // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
     $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $target_dir . DIRECTORY_SEPARATOR;

     // Adding timestamp with image's name so that files with same name can be uploaded easily.
     $mainFile = $uploadPath.time().'-'. $_FILES['file']['name'];

     move_uploaded_file($tempFile,$mainFile);
}

}// end request == 1

if($request == 2){
 $filename = $target_dir.$_POST['name'];  
 unlink($filename); 
 exit;
}
?>

