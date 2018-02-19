<?php
ini_set('display_errors', 1);
$total = count($_FILES['fileToUpload']['name']);
echo "$total";
//if($total < 20){
//    echo "Sorry, the minimum number of images is 20";
//}

//else{

Unique id for the process request
$uniqid = ( [ string $prefix = "" [, bool $more_entropy = FALSE ]] )
$target_dir = "uploads/" . $uniqid . "/";
// $target_dir = "uploads/";
echo "targetdir ";
echo $uniqid;
if( is_dir($target_dir) === false ) // Should always be false, as it is a unique id
{
    mkdir($target_dir);
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
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
//}
?>
