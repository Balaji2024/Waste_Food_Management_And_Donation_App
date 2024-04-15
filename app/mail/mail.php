<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';




// $subject = "Account Verification Mail From ";
// $messsage = "Thank You ! for creating account in " . ". Please click on";
// $action = "Verify Account";
// $flag = "activate";
// $site_url = "wwww.google.com";
// $purpose = 2; // verify email
// VerificationMail("projectswithdigambar@gmail.com", $subject, $messsage, $action, "1234567890", $flag, $site_url);




function VerificationMail($email, $subject, $message, $action, $vkey, $flag, $url)
{

    $vlink = $url . "/app/authentication/verify.php?vkey=" . $vkey . "&flag=" . $flag;

    try {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = EMAIL;
        $mail->Password = PASSWORD;

        $url = SITE_URL . '/app/mail/template/verification.php';

        $content = file_get_contents($url);
        $mail->setFrom(EMAIL, STORE_NAME);
        $mail->addAddress($email);
        $mail->addReplyTo(EMAIL);

        $mail->isHTML(true);
        $mail->Subject = $subject;


        $swap_var = array(

            "{vlink}" => "$vlink",


        );

        foreach (array_keys($swap_var) as $key) {
            if (strlen($key) > 2 && trim($key) != "") {
                $content = str_replace($key, $swap_var[$key], $content);
            }
        }


        $mail->Body = "$content";

        if (!$mail->send()) {
            return "mail not sent";
        } else {
            return "done";
        }
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


function activationMail($email, $subject, $name)
{

    include "../../config.php";

    try {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = EMAIL;
        $mail->Password = PASSWORD;

        $url = SITE_URL . '/app/mail/template/activated.php';

        $content = file_get_contents($url);
        $mail->setFrom(EMAIL, STORE_NAME);
        $mail->addAddress($email);
        $mail->addReplyTo(EMAIL);

        $mail->isHTML(true);
        $mail->Subject = $subject;


        $swap_var = array(

            "{name}" => "$name",


        );

        foreach (array_keys($swap_var) as $key) {
            if (strlen($key) > 2 && trim($key) != "") {
                $content = str_replace($key, $swap_var[$key], $content);
            }
        }


        $mail->Body = "$content";

        if (!$mail->send()) {
            return "mail not sent";
        } else {
            return "done";
        }
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
