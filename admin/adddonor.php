<?php 
include('head.php'); 
include('../dbcon.php');
$msg = "";
//check if the form is submitted
if(isset($_POST['submit'])){
	//Capture data from the form 
	$fullnames = mysqli_real_escape_string($con, $_POST['fullnames']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$phone = mysqli_real_escape_string($con, $_POST['phone']); 
	//insert into the database
	$insert = mysqli_query($con, "insert into donors(fullnames, email, phone) values('$fullnames','$email','$phone')");
	if($insert){
		header("location:donorslist.php");
	}
	else{
		$msg = "Donor could not be added";
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
		<h3>Add Donor</h3>
		<form method="POST" action="">
			<label>Full names</label> <br>
			<input type="text" required name="fullnames"><br><br>
			<label>Email</label> <br>
			<input type="text" required name="email"><br><br> 
			<label>Phone</label> <br>
			<input type="text" required name="phone"><br><br>  
			<input type="submit" name="submit" value="Add donor">
		</form>
	</div>
</body>
</html>

<?php include('footer.php'); ?>