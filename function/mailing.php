<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mailer/vendor/phpmailer/src/Exception.php';
require 'mailer/vendor/phpmailer/src/PHPMailer.php';
require 'mailer/vendor/phpmailer/src/SMTP.php';

require 'mailer/vendor/autoload.php';

if(!function_exists('sendMailToMe')){
    function sendMailToMe($from,$subject,$message){
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host       = 'mail56.lwspanel.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'gerant@cabinet-ccgim.com';
            $mail->Password   = 'nC6_e6vne7HJrMT';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->setFrom($from);
            $mail->addReplyTo($from);
            $mail->addAddress('gerant@cabinet-ccgim.com', 'CCGIM');
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->send();
            return 'send';
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}


if(!function_exists('sendMailToMes')){
    function sendMailToMes($from,$subject,$message){
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 0;
            $mail->setFrom($from);
            $mail->addReplyTo($from);
            $mail->addAddress('gerant@cabinet-ccgim.com', 'CCGIM');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            return 'send';
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}




if(!function_exists('sendMailNoReply')){
    function sendMailNoReply($to,$subject,$message){
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host       = 'mail56.lwspanel.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'test@aeek-kassere.com';
            $mail->Password   = 'xF1-2_nXJABV4$a';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->setFrom('test@aeek-kassere.com', 'Aeek Kassere');
            $mail->addAddress($to);
            $mail->addReplyTo('test@aeek-kassere.com', 'Aeek Kassere');
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->send();
            return 'send';
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}




