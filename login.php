<?php 



include('connections/connections.php');


$email=$_POST['email'];

$password=$_POST['password'];


$error="";


if(empty($email)||empty($password)){

	$error="Enter Complete details";
}
$email=mysqli_escape_string($connect,filter_var(strip_tags($email),FILTER_VALIDATE_EMAIL));
$password=mysqli_escape_string($connect,filter_var(strip_tags($password),FILTER_SANITIZE_STRIPPED));


if(empty($error)){

$sql="SELECT email,password FROM register where email='$email' and password='$password'";

$result=mysqli_query($connect,$sql);


if ($result) {
	echo "data has been successfullyy inserted";
}}










?>