<?php

include "../../connection.php";

// Starting Session
session_start();


if (isset($_REQUEST['AccountNo'])) {

    $Acno = $_REQUEST['AccountNo'];
    $id = $_REQUEST['id'];


    $query = "SELECT * FROM requests JOIN volunteer ON requests.SenderAccountNo=volunteer.accountNo WHERE requests.id = '$id' AND  requests.SenderAccountNo = '$Acno'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        $myjson =  json_encode($data);
        $myjson = trim($myjson, '[]');
        echo $myjson;
        // checking account is active or not 
    } else {
        $arr['success'] = false;
        echo json_encode($arr,  JSON_PRETTY_PRINT);
    }
} else {
    echo "invalid request";
}
