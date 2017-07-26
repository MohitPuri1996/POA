<?php

include("connections/connections.php");
require 'PHPMailerAutoload.php';
$sname=$_POST['sname'];
$sid=$_POST['semail'];

echo $sname,$sid;
$error="";
if(empty($sname)||empty($sid)){

$error .="Enter complete fields";



}
$sname=mysqli_escape_string($connect,filter_var(strip_tags($sname),FILTER_SANITIZE_STRIPPED));
    $sid=mysqli_escape_string($connect,filter_var(strip_tags($sid),FILTER_VALIDATE_EMAIL));


if(empty($error)){

$sql="SELECT email FROM subscribers where email='$sid'";

$result=mysqli_query($connect,$sql);

if($result){
	$sql="INSERT INTO subscribers(name,email) VALUES('$sname','$sid')";

$result=mysqli_query($connect,$sql);

if($result)
{
	echo "Successfully inserted";
mailAll();
}



}



}





function mailAll()

{
include("connections/connections.php");
$sql = "SELECT * FROM subscribers";
$res=mysqli_query($connect,$sql);
    while($row=mysqli_fetch_assoc($res))
    {
            $email=$row['email'];
            $name=$row['name'];
           
$mailto=$email;
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
$mail->Password = 'mahi@1324';                           // SMTP password
$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('mpuri108@gmail.com', 'Mailer');
$mail->addAddress($mailto);     // Add a recipient

    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML


$otp=rand(1,1000);


$mail->Subject = 'New Blog ';
$mail->Body    = 'Dear '.$name.'A new Blog Is inserted in the list Please check it out at http://planofaction.in .';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	
    echo 'Message has been sent';
    }



}}






?>