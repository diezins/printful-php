<?php
require_once 'config.php';   

function getConnection(){
      $link = new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB) or die("Error " . mysqli_error($link));
      $link->set_charset("utf8");
      return $link;
}

// previously used code in other files
    // $db = new mysqli('127.0.0.1', 'root', '', 'survey');
    // if ($db->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
// --------------------
?>