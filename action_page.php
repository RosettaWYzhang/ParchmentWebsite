<?php
ini_set('display_errors', 1);
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
   // username and password sent from form

   $myusername = mysqli_real_escape_string($link,$_POST['username']);
   $mypassword = mysqli_real_escape_string($link,$_POST['password']);

   $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
   $result = mysqli_query($link,$sql);
   if (!$result) {
       printf("Error: %s\n", mysqli_error($link));
       exit();
   }
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   //$active = $row['active'];

   $count = mysqli_num_rows($result);

   // If result matched $myusername and $mypassword, table row must be 1 row

   if($count == 1) {
       echo "login successful";
       session_start();
       $_SESSION['username'] = "wanyue";
       header("location: services.php");
       exit();
   }else {
      $error = "Your Login Name or Password is invalid";
      echo "login not successful";
   }
}
?>
