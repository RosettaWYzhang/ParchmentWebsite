<?php
//linked to cancel button in the upload section
session_start();
$dataset_id = $_POST["delete_dataset"];
$username = $_SESSION["username"];
$dir="uploads/".$username;

shell_exec("bash delete_data.sh $dir $dataset_id");
header('location: http://parchment.cloudapp.net/services.php#viewGallery');
?>
