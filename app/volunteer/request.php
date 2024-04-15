<?php


include "../../connection.php";
include "../mail/mail.php";
include "../../config.php";



if (isset($_REQUEST['FoodRequest'])) {


    $SenderAccountNo = $_REQUEST['SenderAccountNo'];
    $FoodDetails = $_REQUEST['FoodDetails'];
    $FoodQuantity = $_REQUEST['FoodQuantity'];
    $CookingTime = $_REQUEST['CookingTime'];
    $Address     = $_REQUEST['Address'];
    $ZipCode     = $_REQUEST['ZipCode'];
    $longitude     = $_REQUEST['longitude'];
    $latitude     = $_REQUEST['latitude'];
    $Status     = $_REQUEST['Status'];

    $arr = [];

    if (!empty($SenderAccountNo) && !empty($FoodDetails) && !empty($FoodQuantity) && !empty($CookingTime) && !empty($Address) && !empty($ZipCode) && !empty($longitude) && !empty($latitude) && !empty($Status)) {


        $query = "INSERT INTO requests(SenderAccountNo, FoodDetails, FoodQuantity, CookingTime, Address, ZipCode, longitude, latitude, Status) VALUES ('$SenderAccountNo', '$FoodDetails', '$FoodQuantity', '$CookingTime', '$Address', '$ZipCode', '$longitude', '$latitude', '$Status')";
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
