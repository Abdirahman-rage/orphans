<?php  
include('../dbcon.php'); 
$id = $_REQUEST['id']; 
$delete = mysqli_query($con, "update donors set status='inactive' where id='$id' ");
if($delete){
	header("location:donorslist.php");
}
else{
	echo "Donor could not be removed";
}
?>