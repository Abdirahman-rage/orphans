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
		<h3>List of orphans with donors</h3>
		<?php 
			$retrieve = mysqli_query($con, "select orphans.*, donors.fullnames from orphans inner join donors on orphans.donor=donors.id order by id desc ");
			if(mysqli_num_rows($retrieve)==0){
				echo "<h4>No records to display</h4>";
			}
			else{
				echo "<table border='1'>";
					echo "<tr> <th>Sno</th> <th>Orphan number</th> <th>Firstname</th> <th>Middlename</th> <th>Lastname</th> <th>District</th> <th>Donor</th> <th>Action</th> </tr>";
				
				$sno = 1;
				while($row = mysqli_fetch_array($retrieve)){
					echo "<tr>";
						$id = $row['id'];
						echo "<td>".$sno."</td>";
						echo "<td>".$row['onum']."</td>";
						echo "<td>".$row['firstname']."</td>";
						echo "<td>".$row['middlename']."</td>";
						echo "<td>".$row['lastname']."</td>"; 
						echo "<td>".$row['district']."</td>";
						echo "<td>".$row['fullnames']."</td>";   
						echo "<td> <a href='view.php?id=$id'>View more</a> </td>"; 
					echo "</tr>";
					$sno++;
				}
				echo "</table>";
			}
		?>
		
		</p>
	</div>
</body>
</html>

<?php include('footer.php'); ?>