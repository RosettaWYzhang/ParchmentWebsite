<?php
ini_set('display_errors', 1);
session_start();

$id = $_GET['id'];
$datasetName = shell_exec("sh findSubDir.sh $id");
$username = $_SESSION['username'];
shell_exec("sh trigger_bundler.sh $datasetName $username")

?>
