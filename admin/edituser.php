<?php 
include('head.php'); 
include('../dbcon.php');
$msg = "";

$id = $_REQUEST['id'];
//check if the form is submitted
if(isset($_POST['submit'])){
	//Capture data from the form 
	$fullnames = mysqli_real_escape_string($con, $_POST['fullnames']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$type = mysqli_real_escape_string($con, $_POST['type']); 

	$photo = $_FILES['photo']['name'];
	$location = "../profilepics/".$photo;

	//update the database
	$update = mysqli_query($con, "update users set fullnames='$fullnames', email='$email', type='$type', photo='$photo' where id='$id'");
	if($update && move_uploaded_file($_FILES['photo']['tmp_name'], $location)){
		header("location:users.php");
	}
	else{
		$msg = "User could not be updated";
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
			$retrieve = mysqli_query($con, "select * from users where id='$id' ");
			$row = mysqli_fetch_array($retrieve);
		?>
		<form method="POST" action="" enctype="multipart/form-data">
			<label>Full names</label> <br>
			<input type="text" required name="fullnames" value="<?php echo $row['fullnames']; ?>" ><br><br>
			<label>Email</label> <br>
			<input type="text" required name="email" value="<?php echo $row['email']; ?>" ><br><br>
			<label>User type</label> <br>
			<select required name="type">
				<option value="">Choose user level</option>
				<option value="Admin">Admin</option>
				<option value="Representative">Representative</option>
			</select> <br><br>
			<label>Photo</label> <br> 
			<input type="file" name="photo"><br><br>
			<input type="submit" name="submit" value="Update user">
		</form>
	</div>
</body>
</html>

<?php include('footer.php'); ?>