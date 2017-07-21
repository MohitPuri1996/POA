<?php
$conn=mysqli_connect("localhost","root","root","intern") or die("UNABLE TO CONNECT");
$query="SELECT * FROM `register` where 1";
$query=mysqli_query($conn,$query);
while($rst=mysqli_fetch_assoc($query)){
$temp[]=$rst;
}
echo json_encode($temp);
?>