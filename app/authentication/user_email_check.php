<?php

include "../../connection.php";


// Volunteer Registration System


if (isset($_REQUEST['username'])) {
    $arr = [];
    $flag =  UsernameCheck(($_REQUEST['username']));
    if ($flag == 0) {
        $arr['success'] = true;
    } else {
        $arr['success'] = $flag;
    }

    echo json_encode($arr,  JSON_PRETTY_PRINT);
}

if (isset($_REQUEST['email'])) {
    $arr = [];
    $flag =  emailCheck(($_REQUEST['email']));
    if ($flag == 0) {
        $arr['success'] = true;
    } else {
        $arr['success'] = $flag;
    }

    echo json_encode($arr,  JSON_PRETTY_PRINT);
}

if (isset($_REQUEST['phone'])) {
    $arr = [];
    $flag =  phoneCheck(($_REQUEST['phone']));
    if ($flag == 0) {
        $arr['success'] = true;
    } else {
        $arr['success'] = $flag;
    }

    echo json_encode($arr,  JSON_PRETTY_PRINT);
}

if (isset($_REQUEST['ngoId'])) {
    $arr = [];
    $flag =  ngoIdCheck(($_REQUEST['ngoId']));
    if ($flag == 0) {
        $arr['success'] = true;
    } else {
        $arr['success'] = $flag;
    }

    echo json_encode($arr,  JSON_PRETTY_PRINT);
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

function ngoIdCheck($ParsedId)
{

    $id =  $ParsedId;

    if (!empty($id)) {



        $query = "SELECT ngoId FROM ngo WHERE ngoId ='$id'";

        $result = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));
        if (mysqli_num_rows($result) > 0) {

            return "* ngo id already exist";
        } else {
            return 0;
        }
    } else {
        return "ngo id cannot empty";
    }
}
