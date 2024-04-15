<?php


include "../../connection.php";
include "../mail/mail.php";
include "../../config.php";



if (isset($_REQUEST['accountNo'])) {


    $accountNo = $_REQUEST['accountNo'];
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $address = $_REQUEST['address'];
    $pincode = $_REQUEST['pincode'];

    $arr = [];

    if (!empty($accountNo) && !empty($fname) && !empty($lname) && !empty($address) && !empty($pincode)) {

        $query = "UPDATE volunteer SET fname = '$fname', lname = '$lname', address = '$address', pincode = '$pincode' WHERE accountNo = '$accountNo'; ";
        $result =  mysqli_query($conn, $query) or die(mysqli_error($conn));

        if ($result) {
            $arr['success'] = true;
        } else {
            $arr['success'] = false;
        }
    } else {
        $arr['success'] = false;
    }

    echo json_encode($arr,  JSON_PRETTY_PRINT);
}
