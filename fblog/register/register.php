<?php


include('../connections/connections.php');



$firstname=$_GET['firstname'];
$lastname=$_GET['lastname'];
$email=$_GET['email'];
$password=$_GET['password'];

echo $firstname;

$error="";
$result="";
$success="";

if(empty($firstname)||empty($lastname)||empty($email)||empty($password)){

	$error="Enter Complete details";
}

$firstname=mysqli_escape_string($connect,(filter_var(strip_tags($firstname),FILTER_SANITIZE_STRIPPED)));
 $lastname=mysqli_escape_string($connect,filter_var(strip_tags($lastname),FILTER_SANITIZE_STRIPPED));
    $email=mysqli_escape_string($connect,filter_var(strip_tags($email),FILTER_VALIDATE_EMAIL));
 $password=mysqli_escape_string($connect,filter_var(strip_tags($password),FILTER_SANITIZE_STRIPPED));


$sql="SELECT * FROM register WHERE email='$email'";

echo "hi ";
$result=mysqli_query($connect,$sql);

//echo "<br>result" .$result;

$result2=mysqli_fetch_all($result,MYSQLI_ASSOC);
if(mysqli_num_rows($result)>0){

 	$error .="Email already exists";

 }

//echo("iuh");
echo("eroror") .$error;
if(empty($error)){	

$sql="INSERT INTO register (firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password')";
$result=mysqli_query($connect,$sql);

if ($result) {
	$success= "data has been successfullyy inserted";
	mysqli_close($connect);
}
echo "bye";
}
?>