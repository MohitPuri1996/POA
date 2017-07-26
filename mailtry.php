<?php
require 'PHPMailerAutoload.php';
$mailto=$_POST['email'];
echo $mailto;
$mail = new PHPMailer();
$mail->SMTPDebug = 2;                               // Enable verbose debug output
$mail->Debugoutput = 'html';
$mail->isSMTP();      
                                // Set mailer to use SMTP
//$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';                               // Enable SMTP authentication
$mail->Username = 'mpuri108@gmail.com';                 // SMTP username
$mail->Password = '---------------';                           // SMTP password
$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('mpuri108@gmail.com', 'Mailer');
$mail->addAddress($mailto);     // Add a recipient

    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML


$otp=rand(1,1000);


$mail->Subject = 'OTP';
$mail->Body    = 'Your OTP is' .$otp;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	
    echo 'Message has been sent';
}