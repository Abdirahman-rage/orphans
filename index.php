<?php
session_start();
include('dbcon.php');
$msg = "";
//check if the form is submitted
if(isset($_POST['login'])){
	//Capture data from the form  
	$email = mysqli_real_escape_string($con, $_POST['email']); 
	$password = mysqli_real_escape_string($con, $_POST['password']); 
	$encryptPass = base64_encode($password); 

	//check if login details exist
	$checklogin = mysqli_query($con, "select * from users where email='".$email."' and password='".$encryptPass."' ");
	if(mysqli_num_rows($checklogin)==1){
		$row = mysqli_fetch_array($checklogin);
		$fullnames = $row['fullnames'];
		$_SESSION['fullnames']=$fullnames;

		$email = $row['email'];
		$_SESSION['email']=$email;

		$type = $row['type'];
		if($type=="Admin"){
			header("location:admin/home.php");
		}
		else{
			header("location:home.php");
		} 
	} 
	else{
		$msg = "Wrong login details. Try again.";
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

	<form method="POST" action="" class="login-form">
		<p style="color: white; font-size: 18px; text-align: center;"><?php echo $msg; ?></p>
		<h3>Login Here</h3>
		<label>Email</label> <br>
		<input type="email" name="email" placeholder="Enter your email"> <br><br>

		<label>Password</label> <br>
		<input type="password" name="password" placeholder="Enter your password"> <br><br>
		<input type="submit" name="login" value="Login">
	</form>
</body>
</html>