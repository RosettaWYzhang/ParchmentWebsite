<?php
ini_set('display_errors', 1);
session_start();

//default: user wants to upload images
$request = 1;
//request == 2 means that the user wants to delete the image
if(isset($_POST['request'])){ 
  $request = $_POST['request'];
}
shell_exec("echo 'display request in dropzone upload' >> debug.txt");
shell_exec("echo  $request >> debug.txt");
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
     //   $mainFile = $_FILES['file']['name'];
     move_uploaded_file($tempFile,$mainFile); 

/*foreach ($_FILES["file"]["error"] as $key => $error)  {
    if ( $error == UPLOAD_ERR_OK ) {                
        $tempFile = $_FILES['file']['tmp_name'][$key];

        $name = $_FILES["file"]["name"][$key];
        $file_extension = end((explode(".", $name))); # extra () to prevent notice

        $targetPath = FCPATH . $target_dir . $ds;  //4

        $file_new_name = uniqid(). '.'. $file_extension;

        $targetFile =  $targetPath. $file_new_name  ;  //5

        move_uploaded_file($tempFile,$targetFile); //6    
    }
} */
     shell_exec("echo 'moving file successsful, target directory is : ' >> debug.txt");
     shell_exec("echo $target_dir >> debug.txt");
}else{
     shell_exec("echo 'file is empty' >> debug.txt");
}
}// end request == 1

if($request == 2){
 $filename = $target_dir.$_POST['name'];  
 //unlink($filename);
 $withoutUpload = substr($filename, strpos($filename, "/") + 1);
 $withoutUsername = substr($withoutUpload, strpos($withoutUpload, "/") + 1);
 $deletePath = $target_dir."*-".$withoutUsername;
 shell_exec("echo 'file to remove is ' >> debug.txt");
 shell_exec("echo $filename >> debug.txt");
 shell_exec("echo $deletePath >> debug.txt");
 shell_exec("rm '".$target_dir."'*-'".$withoutUsername."'"); 
 exit();
}
?>

