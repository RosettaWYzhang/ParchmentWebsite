<?php
// tutorial https://docs.microsoft.com/en-us/azure/mysql/connect-php
$host = 'parchmentdb.mysql.database.azure.com';
$username = 'team35@parchmentdb';
$password = 'parchment35!';
$db_name = 'login';

//Establishes the connection
$link = mysqli_init();
mysqli_real_connect($link, $host, $username, $password, $db_name, 3306);
if (mysqli_connect_errno($link)) {
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}

?>
