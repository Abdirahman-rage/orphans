<?php 
include('head.php'); 
include('../dbcon.php');
$msg = "";
//check if the form is submitted
if(isset($_POST['submit'])){
	//Capture data from the form  
	$onum2 = mysqli_real_escape_string($con, $_POST['onum2']);
	$amount = mysqli_real_escape_string($con, $_POST['amount']);

		$insert = mysqli_query($con, "insert into stipends(onum, amount) values('$onum2','$amount')");

		if($insert) {
			$msg = "Stipend successfully granted";
		}
		else{
			$msg = "Stipend not be granted";
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
		<h3>Check Stipend</h3>
		<form method="POST" action="">
		<label>Search orphan number</label> <br>
			<input type="number" required name="onum" ><br><br> 
		</form>
		<?php
		if(isset($_POST['onum'])){

			$representative = $_SESSION['email'];
			$onum = $_POST['onum'];
			$retrieve = mysqli_query($con, "select * from orphans where onum='$onum'");
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

					$onum = $row['onum'];
			        $retrieve2=mysqli_query($con,"select CONCAT(MONTH(date) ,' ', YEAR(date)) AS 'Month', amount from stipends where onum='$onum' ORDER BY date ASC");
			        if(mysqli_num_rows($retrieve2) !=0)
			        {
					     echo "<h3>Stipends granted</h3>";
					     echo "<br>";
					        echo "<table style='margin-bottom:20px;'>";
					        echo "<tr>";
					        echo "<th>No.</th>"; 
					        echo "<th>Month</th>";
					        echo "<th>Amount</th>";
					        echo "</tr>";
					        $counter = 001;
					        $sum=0;
					    while($row2=mysqli_fetch_array($retrieve2))//fetch the row2 values
					    {    
					       echo "<tr style='text-align:center;'>";
					        echo "<td>" .$counter. "</td>";
					        echo "<td>".$row2['Month']."</td>"; 
					        echo "<td>".$row2['amount']."</td>"; 
					        echo "</tr>";
					        $counter++;
					        $sum += $row2['amount'];
					    }
					    	echo "<tr style='font-size:20px; background:grey; font-weight:bold;'>";
					        echo "<td style='text-align:left;'>Total</td>";
					        echo "<td colspan='6' style='text-align:right;'>".$sum."</td>"; 
							echo "</tr>";
					    echo "</table>";  
					    echo "<br>";
					    echo "<hr>";
						echo "<p style='font-style:italic;'>Registered by ".$row['representative']."</p>";
					}  
				}
			}
			}
		?>
	</div>
</body>
</html>

<?php include('footer.php'); ?>