<?php
// used to connect to the database
$host = "localhost";
$db_name = "manage";
$username = "pkbar";
$password = "ZwxhAV8e";

try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
}

// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

?>