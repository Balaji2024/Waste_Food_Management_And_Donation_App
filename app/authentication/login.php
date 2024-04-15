<?php

include "../../connection.php";

// Starting Session
session_start();

if (isset($_REQUEST['username'])) {

  $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
  $password =  mysqli_real_escape_string($conn, $_REQUEST['password']);
  $data = [];

  if (empty(trim($_REQUEST['password'])) && empty(trim($_REQUEST['username']))) {

    $error = "* Username and Password required";

    $data['success'] = $error;
    echo json_encode($data);
  } elseif (empty(trim($_REQUEST['username']))) {

    $error = "* Username required";

    $data['success'] = $error;
    echo json_encode($data);
  } elseif (empty(trim($_REQUEST['password']))) {

    $error = "* Password required";

    $data['success'] = $error;
    echo json_encode($data);
  } else {

    $password = md5($password);
    $query = "SELECT * FROM accounts WHERE (username= '$username' OR email='$username') AND Password= '{$password}'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $vstatus = $row['vstatus'];
        $adminStatus = $row['adminCheck'];
        $flag = $row['accountType'];
        $email = $row['email'];
        $createdate = $row['createdate'];
        $AccountNo = $row['accountNo'];
        $username = $row['username'];
      }


      // checking account is active or not 

      if ($vstatus == 1) {

        // checking is it admin account or user account
        if ($flag == 'admin') {
          // if ngo account

          $data = array(
            'success' => true,
            'type' => 'admin'
          );

          echo json_encode($data);
        } else {
          // if volunteer/ngo account

          if ($adminStatus == "0" && $flag == "ngo") {
            $error = "Your account is under verification, will activated within 24 hours";
            $data['success'] = $error;
            echo json_encode($data);
          } else {

            $data = array(
              'success' => true,
              'type' => $flag,
              'accountNo' => $AccountNo,
              'username' => $username,
            );
            echo json_encode($data);
          }
        }
      } else {
        $error = "Account not activated, please check your email";
        $data['success'] = $error;
        echo json_encode($data);
      }
    } else {
      $error = " * Invalid username and password";
      $data['success'] = $error;
      echo json_encode($data);
    }
  }
}
