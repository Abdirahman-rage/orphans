<?php 
include('head.php'); 
include('../dbcon.php');
$msg = "";
//check if the form is submitted
if(isset($_POST['submit'])){
	//Capture data from the form 
	$date_reg = date('d-m-Y');
	$onum = mysqli_real_escape_string($con, $_POST['onum']);
	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$middlename = mysqli_real_escape_string($con, $_POST['middlename']);
	$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
	$dob = mysqli_real_escape_string($con, $_POST['dob']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$age = mysqli_real_escape_string($con, $_POST['age']);
	$district = mysqli_real_escape_string($con, $_POST['district']);
	$gname = mysqli_real_escape_string($con, $_POST['gname']);
	$gcontacts = mysqli_real_escape_string($con, $_POST['gcontacts']);
	$bcertno = mysqli_real_escape_string($con, $_POST['bcertno']);
	
	$representative = $_SESSION['email'];


	$bcert = $_FILES['bcert']['name'];
	$birthcerts = "birthcerts/".$bcert;

	$dcert = $_FILES['dcert']['name'];
	$deathcerts = "deathcerts/".$dcert;

	$natid = $_FILES['natid']['name'];
	$natids = "natids/".$natid;

	$photo = $_FILES['photo']['name'];
	$photos = "photos/".$photo;

	//check if birth certificate is already registered
	$checkbirthcertno = mysqli_query($con, "select * from orphans where bcertno='".$bcertno."' ");
	if(mysqli_num_rows($checkbirthcertno)==1){
		$msg = "Orphan is already registered.";
	} 
	else{
	//insert into the database
		$insert = mysqli_query($con, "insert into orphans(onum, firstname, middlename, lastname, dob, address, age, district, gname, gcontacts, bcertno, bcert, dcert, natid, photo, representative, date_reg) values('$onum','$firstname','$middlename','$lastname','$dob','$address','$age','$district','$gname','$gcontacts','$bcertno','$bcert','$dcert','$natid','$photo','$representative', '$date_reg')");

		if($insert && move_uploaded_file($_FILES['bcert']['tmp_name'], $birthcerts) && move_uploaded_file($_FILES['dcert']['tmp_name'], $deathcerts) && move_uploaded_file($_FILES['natid']['tmp_name'], $natids) && move_uploaded_file($_FILES['photo']['tmp_name'], $photos)) {

			$msg = "Orphan successfully registered";
		}
		else{
			$msg = "Orphan could not be registered";
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
		<h3>Register Orphan</h3>
		<form method="POST" action="" enctype="multipart/form-data">
			<?php
				$retrieve = mysqli_query($con, "select * from orphans order by id desc limit 1");
				$on = mysqli_fetch_array($retrieve);		 
				$lonum = $on['onum']; 
				$newonum = $lonum+001; 
				?>
			<label>Orphan number</label> <br>
			<input type="text" required name="onum" readonly value="<?php echo $newonum; ?>"><br><br>
			<label>First name</label> <br>
			<input type="text" required name="firstname"><br><br>
			<label>Middle name</label> <br>
			<input type="text" required name="middlename"><br><br>
			<label>Last name</label> <br>
			<input type="text" required name="lastname"><br><br>
			<label>Date of birth</label> <br>
			<input type="date" required id="dob" name="dob"><br><br>
			<label>Age</label> <span id="message"></span><br>
			<input type="text" id="age" readonly required name="age"><br><br>
			<label>Address/Location</label> <br>
			<textarea rows="10" cols="30" required name="address"></textarea><br><br>
			<label>District</label> <br>
			<select required name="district">
				<option value="">Choose district</option>
				<?php
				$retrieve = mysqli_query($con, "select * from districts where status='active' ");
				while($row = mysqli_fetch_array($retrieve)){ 
					$name = $row['name'];
					echo "<option value='$name'>".$row['name']."</option>";  
				}
				?>
			</select> <br><br>
			<label>Guardian's name</label> <br>
			<input type="text" required name="gname"><br><br>
			<label>Guardian's contact</label> <br>
			<input type="number" required name="gcontacts"><br><br>
			<label>Birth certficate no. of the orphan</label> <br>
			<input type="text" required name="bcertno"><br><br>
			<label>Birth certificate of the orphan</label> <br>
			<input type="file" name="bcert"><br><br>
			<label>Father's death certificate</label> <br>
			<input type="file" name="dcert"><br><br>
			<label>Mother/Guardian's national ID</label> <br>
			<input type="file" name="natid"><br><br>
			<label>Photo of the orphan</label> <br>
			<input type="file" name="photo"><br><br>
			<input type="submit" name="submit" id="submit" value="Submit">
		</form>
	</div>
</body>
</html>

<?php include('footer.php'); ?>

<script type="text/javascript">
	//To get different in days
    document.getElementById('dob').addEventListener('change', function(){
        let dob = new Date(this.value);
        let today = new Date(); 
        let diffTime = Math.abs(today.getTime() - dob.getTime());
        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24))/365;  
        let result = Math.trunc(diffDays);
        document.getElementById('age').value = result + " year(s) old";

        if(result > 11){
        	document.getElementById('message').innerHTML = "Age should be less than 11 years old";
        	document.getElementById('submit').setAttribute("disabled", true);
        	document.getElementById('submit').setAttribute("style", "background:lightgrey;")
        }
        else{
        	document.getElementById('message').innerHTML = " ";
        	document.getElementById('submit').removeAttribute('disabled');
        	document.getElementById('submit').setAttribute("style", "background:#00ed37;")
        }
        document.getElementById('message').setAttribute("style", "color:red; padding-left:10px;")
    })
</script>