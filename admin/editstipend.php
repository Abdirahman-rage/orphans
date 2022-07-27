<?php 
include('head.php'); 
include('../dbcon.php');
$msg = "";
$id = $_REQUEST['id'];
//check if the form is submitted
if(isset($_POST['update'])){
	//Capture data from the form   
	$amount = mysqli_real_escape_string($con, $_POST['amount']);

		$update = mysqli_query($con, "update stipends set amount='$amount' where id='$id' ");

		if($update) {
			header("location:orphanswithstipend.php");
		}
		else{
			$msg = "Stipend not updated";
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
		<h3>Edit Stipend</h3> 
		<?php 
			$retrieve = mysqli_query($con, "select * from stipends where id='$id' ");
			$row = mysqli_fetch_array($retrieve);
		?>	
			<form method="POST" action="">
			<label>Orphan number</label> <br>
			<input type="number" readonly value="<?php echo $row['onum']; ?>" name="onum" ><br><br>
			<label>Amount</label> <br>
			<input type='number' required value="<?php echo $row['amount']; ?>" name='amount' ><br><br> 
			<input type='submit' name='update' value='Update stipend' ><br><br> 
			</form> 
		
		
	</div>
</body>
</html>

<?php include('footer.php'); ?>