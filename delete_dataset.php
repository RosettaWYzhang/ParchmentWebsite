<?php
session_start();
$dataset_id = $_POST["delete_dataset"];
$username = $_SESSION["username"];
$dir="uploads/".$username;
shell_exec('echo "directory concatenated:" >> debug.txt');
shell_exec("echo $dir >> debug.txt");
shell_exec("echo $dataset_id >> debug.txt");
shell_exec("echo $username >> debug.txt");
shell_exec("bash delete_data.sh $dir $dataset_id");
header("location:services.php");
?>
