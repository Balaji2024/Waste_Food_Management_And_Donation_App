<?php

include "../../connection.php";

// Starting Session
session_start();

$query = "SELECT * FROM requests WHERE Status = 'New' ORDER BY id DESC";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $myjson =  json_encode(['request' => $data]);
    echo $myjson;
} else {
    $arr['request'] = false;
    echo json_encode($arr,  JSON_PRETTY_PRINT);
}
