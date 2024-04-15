<?php

include "../../connection.php";

// Starting Session
session_start();


if (isset($_REQUEST['getStat'])) {

    $ngoAccountNo = $_REQUEST['getStat'];
    $query = "SELECT * FROM requests WHERE Status = 'New' ORDER BY id DESC";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $newResults = mysqli_num_rows($result);

    $query = "SELECT * FROM requests WHERE Status = 'pending' AND ngoAccountNo = '$ngoAccountNo'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $pendingResult = mysqli_num_rows($result);

    $query = "SELECT * FROM requests WHERE Status = 'completed' AND ngoAccountNo = '$ngoAccountNo'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $completeResult = mysqli_num_rows($result);

    $arr = array(
        'new' => $newResults,
        'pending' => $pendingResult,
        'completed' => $completeResult
    );
    echo json_encode($arr,  JSON_PRETTY_PRINT);
}
