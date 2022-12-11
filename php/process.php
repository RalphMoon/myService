<?php

//process.php

$db_host='localhost';
$db_port='3306';
$db_user='user0';
$db_password='1234';
// $db_database='csv';

$pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=csv", $db_user, $db_password);

$sql_query = "SELECT * FROM wrsr";
    
// $sql_query = "SELECT * FROM test0";


$statement = $pdo -> prepare($sql_query);

$statement -> execute();

echo $statement -> rowCount();


?>

