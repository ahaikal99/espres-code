<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-master\src\Exception.php';
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';
    // $mail = new PHPMailer(true);

    // $mail -> isSMTP();
    // $mail -> Host = 'smtp@gmail.com';
    // $mail -> SMTPAuth = true;
    // $mail -> Username = 'arifhaikal228@gmail.com';
    // $mail -> Password = 'tdrjxzbncjdkfobi';
    // $mail -> SMTPSecure = 'ssl';
    // $mail -> Port = 587;
    // $mail->SMTPOptions = array(
    //     'ssl' => array(
    //         'verify_peer' => false,
    //         'verify_peer_name' => false,
    //         'allow_self_signed' => true
    //     )
    // );

    // $mail -> setFrom('arifhaikal228@gmail.com');
    // $mail -> addAddress('ariflegend182@gmail.com');
    // $mail -> isHTML(true);
    // $mail -> Subject = "Total Hour Less Than 10";
    // $mail -> Body = "The total hours worked is less than 10 hours.";
    // $mail -> send();

    $mail = new PHPMailer(true);

$mail->isSMTP();// Set mailer to use SMTP
$mail->CharSet = "utf-8";// set charset to utf8
$mail->SMTPAuth = true;// Enable SMTP authentication
$mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;// Enable TLS encryption, `ssl` also accepted

$mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
$mail->Port = 587;// TCP port to connect to
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->SMTPDebug = 0;
$mail->isHTML(true);// Set email format to HTML

$mail->Username = 'arifhaikal228@gmail.com';// SMTP username
$mail->Password = 'tdrjxzbncjdkfobi';// SMTP password

$mail->setFrom('arifhaikal228@gmail.com', 'arifhaikal228@gmail.com');//Your application NAME and EMAIL
$mail->Subject = 'Test';//Message subject
$mail->MsgHTML('Good Job');// Message body
$mail->addAddress('ariflegend182@gmail.com', 'john');// Target email


$mail->send();

?>