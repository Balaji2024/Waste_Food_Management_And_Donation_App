<?php


include "../../connection.php";
include "../mail/mail.php";
include "../../config.php";

if (isset($_REQUEST['acceptFoodRequest'])) {


    $accountNo = $_REQUEST['acceptFoodRequest'];
    $id = $_REQUEST['id'];
    $arr = [];

    $query = "UPDATE requests SET Status = 'pending', ngoAccountNo = '$accountNo' WHERE id = '$id'";
    $result =  mysqli_query($conn, $query) or die(mysqli_error($conn));

    if ($result) {
        $arr['success'] = true;
    } else {
        $arr['success'] = false;
    }

    echo json_encode($arr,  JSON_PRETTY_PRINT);
}
