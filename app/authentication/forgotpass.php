<?php
include "../../connection.php";
include "../../config.php";
include "../mail/mail_forgotpass.php";


$error = "";
if (isset($_REQUEST['resetPassword'])) {

  $email = $_REQUEST['email'];
  $password = $_REQUEST['resetPassword'];
  if (!empty($email)) {

    $query = "SELECT * FROM accounts WHERE email='{$email}'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (!empty($password)) {

      $eflag = emailCheck($email);

      if ($eflag == 0) {
        if (preg_match_all('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m', $password)) {


          $password = md5($password);
          $query = "UPDATE accounts SET password='{$password}' WHERE email='{$email}'";
          $result = mysqli_query($conn, $query);
          if (!$result) {

            $arr['success'] = mysqli_error($conn);
            echo json_encode($arr,  JSON_PRETTY_PRINT);
          }

          $arr['success'] = true;
          echo json_encode($arr,  JSON_PRETTY_PRINT);
        } else {
          $error = "password not strong";
        }
      } else {
        $arr['success'] = false;
        echo json_encode($arr,  JSON_PRETTY_PRINT);
      }
    } else {
      $error = "Please Enter New password";
    }
  }
}


if (isset($_REQUEST['resetEmail'])) {

  $flag = emailCheck($_REQUEST['resetEmail']);

  if ($flag == 0) {
    $arr['success'] = true;
    echo json_encode($arr,  JSON_PRETTY_PRINT);
  } else {
    $arr['success'] = false;
    echo json_encode($arr,  JSON_PRETTY_PRINT);
  }
}

if (isset($_REQUEST['sendMail'])) {
  $email = $_REQUEST['sendMail'];
  $otp = $_REQUEST['otp'];
  $subject = "password reset otp";
  $message = "here is your one time password";
  $mail = OtpMail($email, $subject, $message, $otp);

  if ($mail == true) {
    $arr['success'] = true;
    echo json_encode($arr,  JSON_PRETTY_PRINT);
  } else {
    $arr['success'] = false;
    echo json_encode($arr,  JSON_PRETTY_PRINT);
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

        return 0;
      } else {
        return "email not found !";
      }
    }
  } else {
    return "email cannot empty";
  }
}
