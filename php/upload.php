<?php
$uploaddir = '/files';
//upload.php

// if(isset($_POST['hidden_field'])) {
 $error = '';
 $total_line = '';
 session_start();

 if($_FILES["uploadFile"]["name"] != '') {
  $allowed_extension = array('csv');
  $file_array = explode(".", $_FILES["uploadFile"]["name"]);
  $extension = end($file_array);
  
  if(in_array($extension, $allowed_extension)) {
    $new_file_name = rand() . '.' . $extension;

    $_SESSION['csv_file_name'] = $new_file_name;
    move_uploaded_file($_FILES["uploadFile"]["tmp_name"], "$uploaddir/$new_file_name"); 
    $file_content = file("$uploaddir/$new_file_name", FILE_SKIP_EMPTY_LINES);
    $total_line = count($file_content); 
    
    } else {
      $error = 'Only CSV file format is allowed';
    }

  } else {
    $error = 'Please Select File';
  }

 if($error != '') {
   $output = array(
   'error'  => $error
  );
 } else {
  $output = array(
   'success'  => true,
   'total_line' => ($total_line - 1),
  );
 }
 
 echo json_encode($output);
// }
?>

