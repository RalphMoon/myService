<?php


$db_host='localhost';
$db_port='3306';
$db_user='user0';
$db_password='1234';
// $db_database='csv';

$pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=csv", $db_user, $db_password);


$uploaddir = '/files';

set_time_limit(0);
ob_implicit_flush(1);

session_start();
$handle = fopen('/files/' . $_SESSION['csv_file_name'], "r");

fgetcsv($handle);

    while (($data = fgetcsv($handle)) !== false) {

        // $name = $data[0];
        // $weeks = $data[1];
        // $gender = $data[2];


        $sql = "INSERT INTO wrsr VALUES ('$data[0]','$data[1]','$data[2]', '$data[3]', '$data[4]')";

        // $sql = "INSERT INTO test0 VALUES ('$data[0]','$data[1]','$data[2]', '$data[3]','$data[4]','$data[5]', '$data[6]','$data[7]','$data[8]', '$data[9]','$data[10]','$data[11]',
        // '$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]')";

        $statement = $pdo -> prepare($sql);

        $statement -> execute($data);

        // sleep(0.5);

        if(ob_get_level() > 0) {
            ob_end_flush();
        }

        unset($_SESSION['csv_file_name']);
    }


?>
