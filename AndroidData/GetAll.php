<?php
if ($_SERVER["REQUEST_METHOD"] == "GET")
    {

    	if(isset($_GET['id'])){
include('../connections/connections.php');
    	$id1=$_GET['id'];

echo "hi" .$id1;
$query="SELECT * FROM `register` where id='$id1'";
$query=mysqli_query($connect,$query);
while($rst=mysqli_fetch_assoc($query)){		
$temp[]=$rst;
}
echo json_encode($temp);
}

else{

include('../connections/connections.php');

$query="SELECT * FROM `register` where 1";
$query=mysqli_query($connect,$query);
while($rst=mysqli_fetch_assoc($query)){
$temp[]=$rst;
}
echo json_encode($temp);
}
}

?>