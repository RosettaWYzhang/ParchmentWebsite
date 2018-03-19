<?php
  session_start();
  $username = $_SESSION['username'];
  chdir('/var/www/parchmentwebsite/downloads');
  shell_exec("zip result.zip /var/www/parchmentwebsite/downloads/$username");
 // shell_exec('mv result.zip /var/www/parchmentwebsite/downloads/');
 // shell_exec('echo "result.zip is moved to downloads" >> debug.txt');

 // shell_exec('cd /services/Parchment/bundler_sfm/bundle zip -r result.zip *');
 // chdir('/var/www/parchmentwebsite/downloads');
// set example variables
$filename = "result.zip";
$filepath = "downloads/";

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

?>
