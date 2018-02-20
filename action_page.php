



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
      //session_register("myusername");
      $_SESSION['login_user'] = $myusername;

      header("location: welcome.php");
   }else {
      $error = "Your Login Name or Password is invalid";
   }
}
/*
ini_set('display_errors', 1);
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        echo "entered validate credentials\n";
        $sql = "SELECT username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            /*
                            echo "password is correct\n";
                            session_start();
                            $_SESSION['username'] = $username;
                            header("location: welcome.php");
                        } else{
                            echo "password not valid\n";
                            echo "$password\n";
                            echo "$hashed_password\n";
                            $answer = password_verify($password, $hashed_password);
                            echo "$answer";
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
*/
?>
