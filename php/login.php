<?php

$db_host='localhost';
$db_user='user0';
$db_password='1234';
$db_database='user';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_database);

if(!$conn) {
    die("Database Connect Error: " . mysqli_connect_error());
}

$userid = $_POST["userid"];
$password = $_POST["password"];


?>