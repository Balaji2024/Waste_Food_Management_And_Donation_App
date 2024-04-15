<?php


include "../../connection.php";


session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.php");
}

if (isset($_POST['VerifyAc'])) {
    $AccountNo = $_POST['VerifyAc'];
    $email = $_POST['email'];
    // echo $AccountNo;
    $query = "UPDATE accounts SET adminCheck = '1' WHERE accountNo = '$AccountNo'";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    include_once "../../app/mail/mail.php";
    $flag = activationMail($email, "Account activated !", $AccountNo);
    header("Location: verify.php");
}

if (isset($_POST['RejectAc'])) {
    $AccountNo = $_POST['RejectAc'];
    // echo $AccountNo;
    $query = "UPDATE accounts SET adminCheck = '2' WHERE accountNo = '$AccountNo'";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    header("Location: verify.php");
}
