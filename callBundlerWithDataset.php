<?php
// helper script called by start service button through JQuery ajax
ini_set('display_errors', 1);
session_start();

$id = $_POST['id'];
$username = $_SESSION['username'];
chdir("uploads");
chdir($username);
$datasetName = shell_exec("bash /var/www/parchmentwebsite/findSubDir.sh $id 2>&1");
chdir("/var/www/parchmentwebsite");
//shell_exec("echo \"print variable $username $datasetName\" >> debug.txt");
shell_exec("./trigger_bundler.sh $username $datasetName");

?>
