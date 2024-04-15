<?php

include "../../connection.php";
include "../mail/mail.php";
include "../../config.php";



if (isset($_REQUEST['completeFoodRequest'])) {


    $accountNo = $_REQUEST['completeFoodRequest'];
    $id = $_REQUEST['id'];
    $arr = [];

    $query = "UPDATE requests SET Status = 'completed', ngoAccountNo = '$accountNo' WHERE id = '$id'";
    $result =  mysqli_query($conn, $query) or die(mysqli_error($conn));


    if ($result) {
        $arr['success'] = true;
    } else {
        $arr['success'] = false;
    }

    echo json_encode($arr,  JSON_PRETTY_PRINT);
}
