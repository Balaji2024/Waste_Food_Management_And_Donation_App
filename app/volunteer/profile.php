<?php

include "../../connection.php";

// Starting Session
session_start();

if (isset($_REQUEST['accountNo'])) {

    $AccountNo = mysqli_real_escape_string($conn, $_REQUEST['accountNo']);
    $data = [];

    $query = "SELECT fname, lname, phone, address, pincode, email, profile
    FROM accounts
    INNER JOIN volunteer ON accounts.accountNo=volunteer.accountNo WHERE accounts.accountNo = '$AccountNo'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        $myjson = json_encode($data);
        $myjson = trim($myjson, '[]');
        echo $myjson;


        // checking account is active or not 


    }
} else {
    $error = " * Invalid username and password";
    $data['success'] = $error;
    echo json_encode($data);
}
