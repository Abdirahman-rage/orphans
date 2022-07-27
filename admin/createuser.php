<?php 
include('head.php'); 
include('../dbcon.php');
$msg = "";
//check if the form is submitted
if(isset($_POST['submit'])){
	//Capture data from the form 
	$fullnames = mysqli_real_escape_string($con, $_POST['fullnames']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$type = mysqli_real_escape_string($con, $_POST['type']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$rpass = mysqli_real_escape_string($con, $_POST['rpass']);
	$encryptPass = base64_encode($password);

	$photo = $_FILES['photo']['name'];
	$location = "../profilepics/".$photo;

	//check if email is already taken or not
	$checkemail = mysqli_query($con, "select * from users where email='".$email."' ");
	if(mysqli_num_rows($checkemail)==1){
		$msg = "Email is already taken. Try another one.";
	}
	//check if passwords match
	else if($password != $rpass){
		$msg = "Passwords do not match. Try again.";
	}
	else{
	//insert into the database
		$insert = mysqli_query($con, "insert into users(fullnames, email, password, type, photo) values('$fullnames','$email','$encryptPass','$type','$photo')");
		if($insert && move_uploaded_file($_FILES['photo']['tmp_name'], $location)){
			header("location:users.php");
		}
		else{
			$msg = "User could not be created";
		}
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
		<h3>Create User</h3>
		<form method="POST" action="" enctype="multipart/form-data">
			<label>Full names</label> <br>
			<input type="text" required name="fullnames"><br><br>
			<label>Email</label> <br>
			<input type="text" required name="email"><br><br>
			<label>User type</label> <br>
			<select required name="type">
				<option value="">Choose user level</option>
				<option value="Admin">Admin</option>
				<option value="Representative">Representative</option>
			</select> <br><br>
			<label>Password</label> <br>
			<input type="password" required name="password"><br><br>
			<label>Repeat password</label> <br>
			<input type="password" required name="rpass"><br><br>  
			<label>Photo</label> <br> 
			<input type="file" name="photo"><br><br>
			<input type="submit" name="submit" value="Create user">
		</form>
	</div>
</body>
</html>

<?php include('footer.php'); ?>