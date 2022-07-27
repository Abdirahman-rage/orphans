<?php 
include('head.php'); 
include('../dbcon.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>
	<div class="main"> 
		<h3>Orphans by district</h3><br>
		 <div class='districts'> 
		<?php 
			$retrieve = mysqli_query($con, "select district from orphans group by district");
				while($row = mysqli_fetch_array($retrieve)){ 
					$district = $row['district'];
					     
						echo "<div><a href='district.php?district=$district'>".$row['district']."</div>";
				   
				} 
			
		?>
		 </div> 
	</div>
</body>
</html>

<?php include('footer.php'); ?>