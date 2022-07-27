<?php 
include('head.php'); 
include('../dbcon.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="main"> 
		<h3>List of donors</h3>
		<?php
			$retrieve = mysqli_query($con, "select * from donors where status='active' ");
			if(mysqli_num_rows($retrieve)==0){
				echo "<h4>No records to display</h4>";
			}
			else{
				echo "<table border='1'>";
					echo "<tr> <th>Sno</th> <th>Fullnames</th> <th>Emails</th> <th>Phone</th> <th>Edit</th> <th>Delete</th></tr>";
				
				$sno = 1;
				while($row = mysqli_fetch_array($retrieve)){
					echo "<tr>";
						$id = $row['id'];
						echo "<td>".$sno."</td>";
						echo "<td>".$row['fullnames']."</td>";
						echo "<td>".$row['email']."</td>";
						echo "<td>".$row['phone']."</td>";  
						echo "<td> <a href='editdonor.php?id=$id'>Edit</a> </td>";
						echo "<td> <a href='deletedonor.php?id=$id'>Delete</a> </td>";
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