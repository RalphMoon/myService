<?php

$db_host='localhost';
$db_port='3306';
$db_user='user0';
$db_password='1234';

$pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=csv", $db_user, $db_password);

$truncate = "TRUNCATE wrsr;";
// $truncate = "TRUNCATE test0;";

$statement = $pdo -> prepare($truncate);

$statement -> execute();

?>