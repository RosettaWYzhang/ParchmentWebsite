<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$username = $_SESSION['username'];
$datasetID = $_POST["datasetID"];

//error handling before zipping, check if dataset is found
$datasetname = "/var/www/parchmentwebsite/downloads/$username/$datasetID";
if(file_exists($datasetname)){
  // dataset exists
  shell_exec("echo /var/www/parchmentwebsite/downloads/$username/$datasetID >> debug.txt");
  $zippingPath = "/var/www/parchmentwebsite/downloads/$username/";
  shell_exec("bash zip.sh $zippingPath $datasetID");

  //error handling for zipping
  $zipname = 'result.zip';
  if(!file_exists($zipname)){
    shell_exec("echo 'in download.php zipping not successful' >> debug.txt");
  }

  $filename = "result.zip";
  $filepath = "/var/www/parchmentwebsite/downloads/";
  $file = $filepath.$filename;
  shell_exec("echo \"$filepath store file path\" >> debug.txt");
  // error handling for file transfer
  shell_exec("echo \'before download error handling\' >> debug.txt");
  if (headers_sent()) {
    shell_exec('echo \"HTTP header already sent\" >> debug.txt');
  } else {
    if (!is_file($file)) {
      header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
      shell_exec('echo \"File not found\" >> debug.txt');
    } else if (!is_readable($file)) {
      header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
      shell_exec('echo \"File not readable\" >> debug.txt');
    } else {
      shell_exec('echo \"download passed error handling\" >> debug.txt');
      // http headers for zip downloads
      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Cache-Control: public");
      header("Content-Description: File Transfer");
      header("Content-type: application/octet-stream");
      header("Content-Disposition: attachment; filename=\"".$filename."\"");
      header("Content-Transfer-Encoding: binary");
      header("Content-Length: ".filesize($filepath.$filename));
      ob_end_flush();
      @readfile($filepath.$filename);
      exit();
    }
  }
}else{
  shell_exec("echo 'dataset not found ' >> debug.txt");
  echo "<script type='text/javascript'>alert('The ID you entered does not match to any processed dataset.');</script>";
  header('Location: services.php');
  exit();
}
?>
