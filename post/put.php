<?php


if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
    	$id1=$_GET['id'];
include('../connections/connections.php');
echo "hi" .$id1;
$query="SELECT * FROM `register` where id='$id1'";
$query=mysqli_query($connect,$query);
while($rst=mysqli_fetch_assoc($query)){
$temp[]=$rst;
}
echo json_encode($temp);

}
else if ($_SERVER["REQUEST_METHOD"] == "PUT")
    {

include('../connections/connections.php');
echo "hi";


    	$id1=$_POST['id'];

$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$password=$_POST['password'];

echo "hi" .$id1;

$error="";
$result="";
$success="";

$firstname=mysqli_escape_string($connect,(filter_var(strip_tags($firstname),FILTER_SANITIZE_STRIPPED)));
 $lastname=mysqli_escape_string($connect,filter_var(strip_tags($lastname),FILTER_SANITIZE_STRIPPED));
    $email=mysqli_escape_string($connect,filter_var(strip_tags($email),FILTER_VALIDATE_EMAIL));
 $password=mysqli_escape_string($connect,filter_var(strip_tags($password),FILTER_SANITIZE_STRIPPED));

if(empty($error)){	

$sql="UPDATE register SET firstname='$firstname',lastname='$lastname',email='$email'password='$password' WHERE id='$id1'";
$result=mysqli_query($connect,$sql);

if ($result) {
	$success= "data has been successfullyy inserted";
	mysqli_close($connect);
}
echo "bye";
}}
?>