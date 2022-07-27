<?php   
include('../dbcon.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head> 
	<link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>
	<div class="print-main"> 
		
		<?php
			$representative = $_SESSION['email'];
			$onum = $_REQUEST['onum'];
			$retrieve = mysqli_query($con, "select * from orphans where onum='$onum' ");
				while($row = mysqli_fetch_array($retrieve))
				{
					echo "<h3>Details of ".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</h3>";
					echo "<br>";  
					echo "<br>";
					echo "<div>";  
						echo "<p><b>Orphan number: </b>".$row['onum']."</p>";
						echo "<p><b>Date of birth: </b>".$row['dob']."</p>"; 
						echo "<p><b>Age: </b>".$row['age']." years old</p>"; 
						echo "<p><b>Address: </b>".$row['address']."</p>"; 
						echo "<p><b>District: </b>".$row['district']."</p>";
						echo "<p><b>Guradian's name: </b>".$row['gname']."</p>"; 
						echo "<p><b>Guradian's contact: </b>".$row['gcontacts']."</p>"; 
						echo "<p><b>Date registered: </b>".$row['date_reg']."</p>"; 

					echo "</div>";  
					echo "<br>";  
					echo "<br>";  			

			        $onum = $row['onum'];
			        $retrieve2=mysqli_query($con,"select CONCAT(MONTH(date) ,' ', YEAR(date)) AS 'Month', amount from stipends where onum='$onum' ORDER BY date ASC");
			        if(mysqli_num_rows($retrieve2) !=0)
			        {
					     echo "<h3>Stipends granted</h3>";
					     echo "<br>";
					        echo "<table border='1' style='margin-bottom:20px;'>";
					        echo "<tr>";
					        echo "<th>No.</th>";  
					        echo "<th>Month</th>";
					        echo "<th>Amount (KSH)</th>"; 
					        echo "</tr>";
					        $counter = 001;
					        $sum=0;
					    while($row2=mysqli_fetch_array($retrieve2))//fetch the row2 values
					    {   
					       $id=$row2['id']; //select the id of the record to display full details
					       echo "<tr style='text-align:center;'>";
					        echo "<td>" .$counter. "</td>"; 
					        echo "<td>".$row2['Month']."</td>"; 
					        echo "<td>".number_format($row2['amount'])."</td>";
					        echo "</tr>";
					        $counter++;
					        $sum += $row2['amount'];
					    }
					    	echo "<tr style='font-size:20px; background:grey; font-weight:bold;'>";
					        echo "<td style='text-align:left;'>Total</td>";
					        echo "<td colspan='6' style='text-align:right;'>".number_format($sum)."</td>"; 
							echo "</tr>";
					    echo "</table>";   ;
					}
				} 
			
			?>
	</div>
</body>
</html>


