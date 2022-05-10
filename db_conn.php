<?php

$dabase_host = "localhost";
$my_user = "root";
$my_password = "";
$my_db = "newdevc";

$conn = mysqli_connect('127.0.0.1', $my_user, $my_password, $my_db);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

mysqli_set_charset($conn, "utf8");