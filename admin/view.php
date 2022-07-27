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
		
		<?php
			$representative = $_SESSION['email'];
			$id = $_REQUEST['id'];
			$retrieve = mysqli_query($con, "select * from orphans where id='$id' "); 
				while($row = mysqli_fetch_array($retrieve))
				{
					echo "<h3>Details of ".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</h3>";
					echo "<div>";  
						echo "<p><b>Orphan number: </b>".$row['onum']."</p>";
						echo "<p><b>Date of birth: </b>".$row['dob']."</p>"; 
						echo "<p><b>Age: </b>".$row['age']." years old</p>"; 
						echo "<p><b>Address: </b>".$row['address']."</p>"; 
						echo "<p><b>District: </b>".$row['district']."</p>";
						echo "<p><b>Guradian's name: </b>".$row['gname']."</p>"; 
						echo "<p><b>Guradian's contact: </b>".$row['gcontacts']."</p>"; 
						$donor = $row['donor'];
						if($donor != "No donor"){
							$donorname = mysqli_query($con, "select * from donors where id='$donor' ");
							$dn = mysqli_fetch_array($donorname); 
							echo "<p><b>Donor: </b>".$dn['fullnames']."</p>";
						}
						else{
							echo "<p><b>Donor: </b>".$row['donor']."</p>"; 
						}

					echo "</div>";  

					echo "<div class='certs'>";  

						echo "<span>";
							echo "<p>Photo</p>";
							$photo = "../photos/".$row['photo'];
							echo "<img class='img' src='$photo'>";
						echo "</span>";

						echo "<span>";
							echo "<p>Birth certificate</p>";
							$bcert = "../birthcerts/".$row['bcert'];
							echo "<img class='img' src='$bcert'>";
						echo "</span>";

						echo "<span>";
							echo "<p>Death certificate</p>";
							$dcert = "../deathcerts/".$row['dcert'];
							echo "<img class='img' src='$dcert'>";
						echo "</span>"; 

						echo "<span>";
							echo "<p>Guardian's national ID</p>";
							$natid = "../natids/".$row['natid'];
							echo "<img class='img' src='$natid'>";
						echo "</span>";  
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
					       $id=$row2['id']; //select the id of the record to display full details
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
					else{
						echo "<h4>No records to display</h4>";
					}
				} 
			
		
		echo "<p style='float: left;width: 100%; text-align: center; margin-top: 20px;'>
			<a href='print.php?onum=$onum' style='background: green; color: white; padding: 5px 10px; border-radius: 5px;'>Print</a>";
			?>
	</div>
</body>
</html>

<?php include('footer.php'); ?>

<script type="text/javascript">
	let certs = document.querySelector('.certs');
	certs.addEventListener('click', function(event){
		let target = event.target;
		if(target.className == "img"){
			let overlay = document.createElement("div");
			overlay.setAttribute("class", "overlay");
			
			let imgtag = document.createElement("img");  
			imgtag.setAttribute("class", "imgtag"); 
			imgtag.setAttribute("src", target.src); 
			overlay.appendChild(imgtag);

			let close = document.createElement("span");
			let txt = document.createTextNode("X");
			close.appendChild(txt);
			close.setAttribute("class", "close");
			overlay.appendChild(close);


			document.body.appendChild(overlay);
		}
	})

	document.body.addEventListener('click', function(event){
		let target = event.target;
		if(target.className == "close"){
			target.parentNode.remove();
		}
	})
</script>