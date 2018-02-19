<?php

$host = 'parchmentdb.mysql.database.azure.com';
$username = 'team35@parchmentdb';
$password = 'parchment35!';
$db_name = 'login';

//Establishes the connection
$conn = mysqli_init();
$link = mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
