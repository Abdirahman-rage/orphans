<?php 
include('head.php'); 
include('../dbcon.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="main"> 
		<h3>Orphans stipend granted</h3>
		<?php 
			$retrievemonth = mysqli_query($con,"SELECT DISTINCT CONCAT(MONTH(date) ,' ', YEAR(date)) AS 'Month' FROM stipends ORDER BY date DESC");
			    while($row = mysqli_fetch_array($retrievemonth)) 
			    { 
					$date = date("Y-m", mktime(0, 0, 0, $row['Month']));
			        $date2 = date("F Y", mktime(0, 0, 0, $row['Month']));
			        echo "<p class='stmnt'> Orphans granted stipend in the Month of ".$date2."</p>"; 

			        $retrieve=mysqli_query($con,"select stipends.onum, stipends.id, amount, firstname, middlename, lastname, district from stipends inner join orphans on stipends.onum=orphans.onum where date LIKE '%$date%' ORDER BY date ASC");

				     echo "<br>";
				        echo "<table style='margin-bottom:20px;'>";
				        echo "<tr>";
				        echo "<th>No.</th>";
				        echo "<th>Orphan number</th>";
				        echo "<th>Firstname</th>";
				        echo "<th>Middlename</th>";
				        echo "<th>Lastname</th>";
				        echo "<th>District</th>";
				        echo "<th>Amount</th>";
				        echo "<th>Edit</th>"; 
				        echo "</tr>";
				        $counter = 001;
				        $sum=0;
				    while($row2=mysqli_fetch_array($retrieve))//fetch the row2 values
				    {    	
				       $id=$row2['id'];  
				       echo "<tr style='text-align:center;'>";
				        echo "<td>" .$counter. "</td>";
				        echo "<td>".$row2['onum']."</td>";
				        echo "<td>".$row2['firstname']."</td>";
				        echo "<td>".$row2['middlename']."</td>";
				        echo "<td>".$row2['lastname']."</td>";
				        echo "<td>".$row2['district']."</td>";
				        echo "<td>".$row2['amount']."</td>"; 
				        echo "<td> <a href='editstipend.php?id=$id'>Edit stipend</a> </td>";
				        echo "</tr>";
				        $counter++;
				        $sum += $row2['amount'];
				    }
				    	echo "<tr style='font-size:20px; background:grey; font-weight:bold;'>";
				        echo "<td style='text-align:left;'>Total</td>";
				        echo "<td colspan='6' style='text-align:right;'>".$sum."</td>"; 
				        echo "<td style='text-align:left;'> </td>";
						echo "</tr>";
				    echo "</table>";  
				    echo "<hr>";
				    echo "<br>";

				}
		?>
		
	</div>
</body>
</html>

<?php include('footer.php'); ?>