<?php

$host = 'parchmentdb.mysql.database.azure.com';
$username = 'team35@parchmentdb';
$password = 'parchment35!';
$db_name = 'users';

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
if (mysqli_connect_errno($conn)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}

//Close the connection
mysqli_close($conn);
?>
