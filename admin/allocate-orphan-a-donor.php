<?php 
include('head.php'); 
include('../dbcon.php');
$msg = "";
//check if the form is submitted
if(isset($_POST['submit'])){
	//Capture data from the form  
	$onum2 = mysqli_real_escape_string($con, $_POST['onum2']);
	$donor = mysqli_real_escape_string($con, $_POST['donor']); 

		$insert = mysqli_query($con, "update orphans set donor='$donor' where onum='$onum2'");

		if($insert) {
			$msg = "Orphan successfully allocated a donor.";
		}
		else{
			$msg = "Allocation not successful";
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
		<h3>Grant Stipend</h3>
		<form method="POST" action="">
		<label>Search orphan number</label> <br>
			<input type="number" required name="onum" ><br><br> 
		</form>
		<?php
		if(isset($_POST['onum'])){

			$representative = $_SESSION['email'];
			$onum = $_POST['onum'];
			$retrieve = mysqli_query($con, "select * from orphans where onum='$onum' ");
			if(mysqli_num_rows($retrieve) == 0){
				echo "<h4>Orphan number doesn't exist</h4>";
			}
			else{
				while($row = mysqli_fetch_array($retrieve)){
					echo "<h3>Details of ".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</h3>";
					echo "<div>";  
						echo "<p><b>Date of birth: </b>".$row['dob']."</p>"; 
						echo "<p><b>Age: </b>".$row['age']." years old</p>"; 
						echo "<p><b>Address: </b>".$row['address']."</p>"; 
						echo "<p><b>District: </b>".$row['district']."</p>";
						echo "<p><b>Guradian's name: </b>".$row['gname']."</p>"; 
						echo "<p><b>Guradian's contact: </b>".$row['gcontacts']."</p>"; 
						echo "<p><b>Date registered: </b>".$row['date_reg']."</p>"; 

					echo "</div>";  
					echo "<hr>";
					echo "<p style='font-style:italic;'>Registered by ".$row['representative']."</p>";
					echo "<hr>";
					echo "<br>";
				}
				echo '<form method="POST" action="">';
				$retrievedonors = mysqli_query($con, "select * from donors where status='active' ");
				echo '<label>Orphan number</label> <br>';
				echo "<input type='number' required value='$onum' name='onum2' ><br><br>";
				echo "<select name='donor' required>";
					echo"<option value=''>Select donor</option>";
					while($row2 = mysqli_fetch_array($retrievedonors)){
						$donorid = $row2['id'];
						echo "<option value='$donorid'>".$row2['fullnames']."</option>";
					}
				echo "</select>";
				echo "<br><br>";
				echo "<input type='submit' name='submit' value='Submit' ><br><br> ";
				echo '</form>'; 
			}
			}
		?>
	</div>
</body>
</html>

<?php include('footer.php'); ?>