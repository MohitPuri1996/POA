<?php


if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

include('../connections/connections.php');
echo "hi";


$firstname=$_POST['firstname'];
$lastname=$_POST_['lastname'];
$email=$_POST['email'];
$password=$_POST['password'];

echo "hi";

$error="";
$result="";
$success="";

$firstname=mysqli_escape_string($connect,(filter_var(strip_tags($firstname),FILTER_SANITIZE_STRIPPED)));
 $lastname=mysqli_escape_string($connect,filter_var(strip_tags($lastname),FILTER_SANITIZE_STRIPPED));
    $email=mysqli_escape_string($connect,filter_var(strip_tags($email),FILTER_VALIDATE_EMAIL));
 $password=mysqli_escape_string($connect,filter_var(strip_tags($password),FILTER_SANITIZE_STRIPPED));

if(empty($error)){	

$sql="INSERT INTO register (firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password')";
$result=mysqli_query($connect,$sql);

if ($result) {
	$success= "data has been successfullyy inserted";
	mysqli_close($connect);
}
echo "bye";
}
}?>