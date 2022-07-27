<?php  
include('../dbcon.php'); 
$id = $_REQUEST['id']; 
$delete = mysqli_query($con, "update districts set status='inactive' where id='$id' ");
if($delete){
	header("location:districts.php");
}
else{
	echo "District could not be removed";
}
?>