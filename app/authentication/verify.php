<?php

use function PHPSTORM_META\type;

session_start();

include "../../connection.php";

// getting vrification key from url
$vkey =  $_GET['vkey'];
$flag = $_GET['flag'];

// cheking this vkey exist in database or not
$vkey = mysqli_real_escape_string($conn, $vkey);
$query = "SELECT * FROM accounts WHERE vkey = '" . $vkey . "'";
$result =  mysqli_query($conn, $query);


// if this key exist then activate account 
if (mysqli_num_rows($result) == 1) {

    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $accountNo = $row['accountNo'];
        $email = $row['email'];
        $type = $row['accountType'];
    }

    // Genrating new vkey to update
    $newVkey = md5(time() . $username);

    // update query to activate account
    $query = "UPDATE accounts SET vstatus = 1, vkey= '$newVkey' WHERE vkey = '$vkey' LIMIT 1";
    $update =  mysqli_query($conn, $query);

    // if query fire successfully 
    if ($update) {

        if ($flag == "reset") {
            session_start();
            $_SESSION['resetpass'] = $username;
            header('Location: resetpassword.php');
        } else if ($flag == "activate" && $type == "volunteer") {
            include_once "../mail/mail.php";
            $flag = activationMail($email, "Account activated !", $username);
        }
    } else {
        mysqli_error($conn);
    }
} else {
    header('Location: ../../index.html');
}
?>


<!DOCTYPE html>
<html>

<head>
    <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../images/favicon/site.webmanifest">
    <title>Thanks for verifying your email account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            padding-top: 50px;
        }

        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #3366cc;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #235daa;
        }
    </style>
</head>

<body>
    <h1>Thanks for verifying your email account!</h1>
    <p>Your account is now verified and you can start using our services.</p>
    <a href="../../index.html" class="btn">Start using our services</a>
</body>

</html>