<?php


include "../../connection.php";
include "../mail/mail.php";
include "../../config.php";



if (isset($_REQUEST['accountNo'])) {


    $accountNo = $_REQUEST['accountNo'];

    $arr = [];

    if (!empty($accountNo)) {

        $query = "SELECT SenderAccountNo FROM requests WHERE SenderAccountNo = '$accountNo';";
        $result =  mysqli_query($conn, $query) or die(mysqli_error($conn));
        $total_donation =  mysqli_num_rows($result);

        $query = "SELECT SenderAccountNo FROM requests WHERE SenderAccountNo = '$accountNo' and Status = 'Completed';";
        $result =  mysqli_query($conn, $query) or die(mysqli_error($conn));
        $total_donation_completed = mysqli_num_rows($result);

        $query = "SELECT SenderAccountNo FROM requests WHERE SenderAccountNo = '$accountNo' and Status = 'Pending';";
        $result =  mysqli_query($conn, $query) or die(mysqli_error($conn));
        $total_donation_pending = mysqli_num_rows($result);

        $arr = array(
            'donation' => $total_donation,
            'completed' => $total_donation_completed,
            'pending' => $total_donation_pending
        );
    } else {
        $arr['success'] = false;
    }

    echo json_encode($arr,  JSON_PRETTY_PRINT);
}
