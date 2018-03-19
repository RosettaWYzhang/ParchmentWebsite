<?php
error_reporting(-1);
ini_set('display_errors','On');
set_error_handler("var_dump");

$email = $argv[1];
shell_exec('echo "bash pass email to php" >> debug.txt');
shell_exec("echo $email >> debug.txt");
shell_exec('echo "Please go to our services page to download the flattened parchment." | mail -s "Your dataset is available" wanyue.zhang.16@ucl.ac.uk');
?>
