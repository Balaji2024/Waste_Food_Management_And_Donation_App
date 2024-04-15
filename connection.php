<?php

// Defining constant php variable for local host

define('DB_host', 'localhost');
define('DB_username', 'id21928634_feedfood');
define('DB_password', 'Feednfood@45');
define('DB_name', 'id21928634_feedfood');


$conn = mysqli_connect(DB_host, DB_username, DB_password, DB_name);

if (!$conn) {
    die("connection failed" . mysqli_connect_error());
    echo "Connection Fail";
}
