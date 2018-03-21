<?php
//remove uploaded images if the user presses cancel button
session_start();
ini_set('display_errors',1);
$foldername = $_SESSION['username'];
$target_user = "uploads/" . $foldername;
shell_exec("rm $target_user/*.jpg");
header('Location: services.php');
?>
