<?php
session_start();
ini_set('display_errors',1);
//require_once 'config.php';
$foldername = $_SESSION['username'];
$id = uniqid (rand(), true);
$_SESSION['uniqueID'] = $id;
$target_user = "uploads/" . $foldername;
$target_dir = "uploads/" . $foldername ."/" .$id;
$fileNum=shell_exec("ls -1q $target_user/*.jpg | wc -l");

if($fileNum==0){
  header('Location: services.php');
  exit;
}
if( is_dir($target_dir) === false ) // Should always be false, as it is a unique id
{
    echo "    Creating dir   ";
    // give full permision
    $oldmask = umask(0);
    mkdir($target_dir, 0777);
    umask($oldmask);
}
//connect to database
$host = 'parchmentdb.mysql.database.azure.com';
$username = 'team35@parchmentdb';
$password = 'parchment35!';
$db_name = 'login';

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
if (mysqli_connect_errno($conn)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}
else{
 shell_exec("echo 'confirm database connected' >> debug.txt");
}

// Run the create table query
$trimmedUsername = preg_replace('/[^a-z0-9]+/i', '', $foldername);
shell_exec("echo 'trimmed username:' >> debug.txt");
shell_exec("echo $trimmedUsername >> debug.txt");
$query = "SELECT ID FROM ".$trimmedUsername;
$result = mysqli_query($conn, $query);
if(empty($result)) {
                shell_exec("echo 'result empty, plan to create new table' >> debug.txt");
                $query = "CREATE TABLE '.$trimmedUsername.' (
                          ID int(11) AUTO_INCREMENT,
                          DATASETID varchar(255) NOT NULL,
                          reg_date TIMESTAMP,
                          PRIMARY KEY  (ID)
                          )";
                $result = mysqli_query($dbConnection, $query);
}
//insert unique ID
//$uniqueID=mysqli_real_escape_string($id);
$sql = "INSERT INTO '".$trimmedUsername."' (datasetId)
VALUES ('".$id."')";
shell_exec("echo $id >> debug.txt");

if ($conn->query($sql) === TRUE) {
    shell_exec("echo 'New record created successfully' >> debug.txt");
} else {
    shell_exec("echo 'data not inserted' >> debug.txt");
    shell_exec("echo $conn->error >> debug.txt");
}

//Close the connection
mysqli_close($conn);

shell_exec("sh moveFile.sh $target_user $target_dir");
header('Location: services.php');
?>
