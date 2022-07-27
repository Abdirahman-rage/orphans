<?php 
include('head.php'); 
include('../dbcon.php');
$msg = "";
//check if the form is submitted
if(isset($_POST['submit'])){
	//Capture data from the form 
	$name = mysqli_real_escape_string($con, $_POST['name']);  

	//check if email is already taken or not
	$checkemail = mysqli_query($con, "select * from districts where name='".$name."' ");
	if(mysqli_num_rows($checkemail)==1){
		$msg = "District is already registered.";
	} 
	else{
	//insert into the database
		$insert = mysqli_query($con, "insert into districts(name) values('$name')");
		if($insert){
			$msg = "District successfully registered";
		}
		else{
			$msg = "District could not be registered";
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
		<h3>Add district</h3>
		<form method="POST" action="" enctype="multipart/form-data">
			<label>Name</label> <br>
			<input type="text" required name="name"><br><br> 
			<input type="submit" name="submit" value="Add district">
		</form>
		<br><br>
		<h3>List of districts</h3>
		<?php
			$retrieve = mysqli_query($con, "select * from districts where status='active' ");
			if(mysqli_num_rows($retrieve)==0){
				echo "<h4>No records to display</h4>";
			}
			else{
				echo "<table border='1'>";
					echo "<tr> <th>Sno</th> <th>District name</th> <th>Status</th> <th>Edit</th> <th>Delete</th></tr>";
				
				$sno = 1;
				while($row = mysqli_fetch_array($retrieve)){
					echo "<tr>";
						$id = $row['id'];
						echo "<td>".$sno."</td>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['status']."</td>";  
						echo "<td> <a href='editdistrict.php?id=$id'>Edit</a> </td>";
						echo "<td> <a href='deletedistrict.php?id=$id'>Delete</a> </td>";
					echo "</tr>";
					$sno++;
				}
				echo "</table>";
			}
		?>
	</div>
</body>
</html>

<?php include('footer.php'); ?>