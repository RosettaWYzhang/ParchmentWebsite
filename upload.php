<?php
ini_set('display_errors', 1);
session_start();

$total = count($_FILES['fileToUpload']['name']);
echo "$total";
if($total < 1){
    echo "Sorry, the minimum number of images is 1";
}

else{
$successFile = 0;

// Unique id for the process request
$id = uniqid (rand(), true);
// $target_dir = "uploads/" . $uniqid . "/";
$target_dir = "uploads/" . $id . "/";
$_SESSION['target_dir'] = $target_dir;
echo "targetdir ";
echo $target_dir;
if( is_dir($target_dir) === false ) // Should always be false, as it is a unique id
{
    echo "    Creating dir   ";
    // give full permision
    $oldmask = umask(0);
    mkdir($target_dir, 0777);
    umask($oldmask);
}

echo "before loop";
for($i=0; $i<$total;$i++){
    echo "loop is entered";
    $uploadOk = 1;
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"][$i] > 50000000000000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"][$i]). " has been uploaded.";
            $successFile++;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

if($successFile < 20){
   // shell_exec("sh trigger_bundler.sh $id");

   // echo "Sorry, you need at least 20 successful images";
    shell_exec("sh trigger_bundler.sh $id 2>&1 | tee -a /tmp/mylog 2>/dev/null >/dev/null &");
}

else{
    //$msg = "First line of text\nSecond line of text";
    // use wordwrap() if lines are longer than 70 characters
   // $msg = wordwrap($msg,70);

    // send email
    //mail("zceeher@ucl.ac.uk","My subject",$msg);
    shell_exec("sh trigger_bundler.sh $id 2>&1 | tee -a /tmp/mylog 2>/dev/null >/dev/null &");
}

}
?>
