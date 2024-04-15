<?php

include "../../connection.php";
include "../mail/mail.php";
include "../../config.php";

if (isset($_REQUEST['volunteer'])) {

    // storing values of form 
    $username =  $_REQUEST['username'];
    $email =  $_REQUEST['email'];
    $password =  $_REQUEST['password'];
    $phone = $_REQUEST['phone'];


    $userFlag = usernameCheck($username);
    $emailFlag = emailCheck($email);
    $passFlag = passwordCheck($password);
    $phoneFlag = PhoneCheck($phone);


    if ($userFlag == 0 && $emailFlag == 0 && $passFlag == 0 && $phoneFlag == 0) {

        // if password match then convert password to md5 hash
        $password = md5($password);

        // Generating Verification Key
        $vkey = md5(time() . $username);
        $accountNo = date('ndyHisL');
        $query = "INSERT INTO accounts(username, accountNo, password, email, vkey, accountType) VALUES ('$username', '$accountNo','$password', '$email','$vkey', 'volunteer')";
        $result =  mysqli_query($conn, $query) or die(mysqli_error($conn));

        $query = "INSERT INTO volunteer(accountNo, phone) VALUES ('$accountNo', '$phone')";
        $result =  mysqli_query($conn, $query) or die(mysqli_error($conn));


        // To send Email
        $subject = "Account Verification Mail From " . STORE_NAME;
        $messsage = "Thank You ! for creating account in " . STORE_NAME . ". Please click on";
        $action = "Verify Account";
        $flag = "activate";
        $site_url = SITE_URL;
        $purpose = 2; // verify email
        $vmail = VerificationMail($email, $subject, $messsage, $action, $vkey, $flag, $site_url);

        $arr = [];

        if ($vmail == "done") {

            if ($result) {
                $arr['success'] = true;
            } else {
                $arr['success'] = false;
            }
        } else {
            echo $vmail;
        }

        echo json_encode($arr,  JSON_PRETTY_PRINT);

        // echo $userFlag.$emailFlag.$passFlag;

    } else {
        return false;
    }
} else {
    return false;
}


function usernameCheck($Parsedusername)
{

    $username =  $Parsedusername;


    if (!empty($username)) {

        if (!preg_match_all('/^[A-Za-z][A-Za-z0-9]{4,31}$/', $username)) {

            // if username format is invalid then show error
            return "username 5 charaters long with letters and numbers";
        } else {

            $query = "SELECT username FROM accounts WHERE username='$username'";
            $result = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));
            if (mysqli_num_rows($result) > 0) {
                return "* username already exist";
            } else {
                return 0;
            }
        }
    } else {
        return "username cannot empty";
    }
}

function emailCheck($Parsedemail)
{

    $email =  $Parsedemail;

    if (!empty($email)) {

        // checking email format 
        if (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $email)) {

            // if email format is invalid then show error
            return "* Invalid email format";
        } else {

            $query = "SELECT email FROM accounts WHERE email='$email'";

            $result = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));
            if (mysqli_num_rows($result) > 0) {

                return "* email already exist";
            } else {
                return 0;
            }
        }
    } else {
        return "email cannot empty";
    }
}

function passwordCheck($password)
{
    if (!empty($password)) {

        // checking password match the conditions or not
        if (!preg_match_all('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m', $password)) {

            // if password not match condition display error
            return "enter strong password";
        } else {
            return 0;
        }
    } else {
        return "password can not empty";
    }
}

function phoneCheck($Parsedphone)
{

    $phone =  $Parsedphone;

    if (!empty($phone)) {

        // checking email format 
        if (!preg_match('/^[0-9]{10}+$/', $phone)) {

            // if email format is invalid then show error
            return "* Invalid phone format";
        } else {

            $query = "SELECT phone FROM volunteer WHERE phone ='$phone'";

            $result = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));
            if (mysqli_num_rows($result) > 0) {

                return "* phone already exist";
            } else {

                $query = "SELECT ngoPhoneNo FROM ngo WHERE ngoPhoneNo ='$phone'";

                $result = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));
                if (mysqli_num_rows($result) > 0) {

                    return "* phone already exist";
                }

                return 0;
            }
        }
    } else {
        return "phone cannot empty";
    }
}
