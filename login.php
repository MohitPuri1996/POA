<?php 

session_start();

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
	$sql="SELECT firstname FROM register where email='$email' and password='$password'";
echo "hi";
$result=mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $firstname = $row['firstname'];
      $_SESSION['user'] = $firstname;
    
      if ($result) {
	  header("location: main/POA/index.php");
		

		}

			}
		else {

			$error="Email or password is not correct";
			}




}










?>