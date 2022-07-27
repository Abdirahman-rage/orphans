<?php 
include('head.php'); 
include('../dbcon.php');
$msg = "";

$id = $_REQUEST['id'];
//check if the form is submitted
if(isset($_POST['update'])){
	//Capture data from the form 
	$fullnames = mysqli_real_escape_string($con, $_POST['fullnames']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$phone = mysqli_real_escape_string($con, $_POST['phone']); 

	//update the database
	$update = mysqli_query($con, "update donors set fullnames='$fullnames', email='$email', phone='$phone' where id='$id'");
	if($update){
		header("location:donorslist.php");
	}
	else{
		$msg = "Donor could not be updated";
	}
	
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="main">
		<p class="msg"><?php echo $msg; ?></p>
		<h3>Edit User</h3>

		<?php
			$retrieve = mysqli_query($con, "select * from donors where id='$id' ");
			$row = mysqli_fetch_array($retrieve);
		?>
		<form method="POST" action="">
			<label>Full names</label> <br>
			<input type="text" required name="fullnames" value="<?php echo $row['fullnames']; ?>"><br><br>
			<label>Email</label> <br>
			<input type="text" required name="email" value="<?php echo $row['email']; ?>"><br><br> 
			<label>Phone</label> <br>
			<input type="text" required name="phone" value="<?php echo $row['phone']; ?>"><br><br>  
			<input type="submit" name="update" value="Edit donor">
		</form>
	</div>
</body>
</html>

<?php include('footer.php'); ?>