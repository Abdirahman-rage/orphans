<?php  
include('../dbcon.php'); 
$id = $_REQUEST['id']; 
$delete = mysqli_query($con, "update users set status='inactive' where id='$id' ");
if($delete){
	header("location:users.php");
}
else{
	echo "User could not be removed";
}
?>