<?php

$db_host='localhost';
$db_user='user0';
$db_password='1234';
$db_database='user';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_database);

if(!$conn) {
    die("Database Connect Error: " . mysqli_connect_error());
}


if (!isset($_POST["email"])) {

    echo "email is";

} else if (isset($_PSOT["email"])) {
    echo "1";
}
// else if ($_POST["email"]) {

//     // $email_sql = 

// }


?>