<?php
	session_start();
	if(!isset($_SESSION['fullnames'])){
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="banner">
		<img src="logo.jpg" class="logo">
		<ul class="menu">
			<li><a href="home.php">Home</a></li>
			<li><a href="mylist.php">My list</a></li>
			<li><a href="orphanswithstipend.php">Orphans stipend granted</a></li>
			<li><a href="#"><?php echo $_SESSION['fullnames']; ?></a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
</body>
</html>