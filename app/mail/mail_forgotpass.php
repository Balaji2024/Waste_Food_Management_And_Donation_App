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

function OtpMail($email, $subject, $message, $otp)
{


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
        $url = SITE_URL . '/app/mail/template/forgot_otp.php';
        $content = file_get_contents($url);
        $mail->setFrom(EMAIL, STORE_NAME);
        $mail->addAddress($email);
        $mail->addReplyTo(EMAIL);

        $mail->isHTML(true);
        $mail->Subject = $subject;


        $swap_var = array(

            "{otp}" => "$otp",

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
            return true;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
