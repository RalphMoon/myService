<?php
$db_host='localhost';
$db_user='user0';
$db_password='1234';
$db_database='csv';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_database);

if(!$conn) {
    die("Database Connect Error: " . mysqli_connect_error());
}

$sql_query = "SELECT * FROM wrsr";

$query_data = mysqli_query($conn, $sql_query);

if($query_data === false) {
    echo mysqli_error($conn);
}

$data = array();

foreach($query_data as $row) {
    $data[] = $row;
}


$column_name = array();

$coulumn_query = "DESC wrsr";

$coulumn_query_data = mysqli_query($conn, $coulumn_query);

while ( $coulumnResult = mysqli_fetch_array($coulumn_query_data)) {
    
    $column_name[] = $coulumnResult[0];
    
}

print json_encode(array($data, $column_name));


?>