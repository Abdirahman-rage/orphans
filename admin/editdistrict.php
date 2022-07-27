<?php 
include('head.php'); 
include('../dbcon.php');
$msg = "";

$id = $_REQUEST['id'];
//check if the form is submitted
if(isset($_POST['submit'])){
	//Capture data from the form 
	$name = mysqli_real_escape_string($con, $_POST['name']);  
	//insert into the database
	$update = mysqli_query($con, "update districts set name = '$name' where id='$id' ");
	if($update){
		header("location:districts.php");
	}
	else{
		$msg = "District could not be updated";
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
		<h3>Add district</h3>
		<?php
			$retrieve = mysqli_query($con, "select * from districts where id='$id' ");
			$row = mysqli_fetch_array($retrieve);
		?>
		<form method="POST" action="" enctype="multipart/form-data">
			<label>Name</label> <br>
			<input type="text" required name="name" value="<?php echo $row['name']; ?>"><br><br> 
			<input type="submit" name="submit" value="Update district">
		</form> 
	</div>
</body>
</html>

<?php include('footer.php'); ?>