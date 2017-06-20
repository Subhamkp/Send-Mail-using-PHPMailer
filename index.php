<?php
//be sure to uncomment uncomment the line extension=php_openssl.dll in php.ini

//Load PHPMailer dependencies
require_once 'PHPMailerAutoload.php';
require_once 'class.phpmailer.php';
require_once 'class.smtp.php';

/* CONFIGURATION */
$crendentials = array(
    'email'     => '@gmail.com',    //Your GMail adress
    'password'  => ''               //Your GMail password
    );

/* SPECIFIC TO GMAIL SMTP */
$smtp = array(

'host' => 'smtp.gmail.com',
'port' => 587,
'username' => $crendentials['email'],
'password' => $crendentials['password'],
'secure' => 'tls' //SSL or TLS

);

/* TO, SUBJECT, CONTENT */
$to         = '@gmail.com'; //The 'To' field
$subject    = 'This is a test email sent with PHPMailer';
$content    = 'This is the HTML message body <b>in bold!</b>';



$mailer = new PHPMailer();

//SMTP Configuration
$mailer->isSMTP();
$mailer->SMTPAuth   = true; //We need to authenticate
$mailer->Host       = $smtp['host'];
$mailer->Port       = $smtp['port'];
$mailer->Username   = $smtp['username'];
$mailer->Password   = $smtp['password'];
$mailer->SMTPSecure = $smtp['secure']; 

//Now, send mail :
//From - To :
$mailer->From       = $crendentials['email'];
$mailer->FromName   = 'Your Name'; //Optional
$mailer->addAddress($to);  // Add a recipient

//Subject - Body :
$mailer->Subject        = $subject;
$mailer->Body           = $content;
$mailer->isHTML(true); //Mail body contains HTML tags

//Check if mail is sent :
if(!$mailer->send()) {
    echo 'Error sending mail : ' . $mailer->ErrorInfo;
} else {
    echo 'Message sent !';
}