<?php
	session_start();
	if(!isset($_SESSION['fullnames'])){
		header("location:../index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>
	<div class="banner">
		<img src="../logo.jpg" class="logo">
		<ul class="menu">
			<li><a href="home.php">Home</a></li>
			<li class="droppar"><a href="#">Orphans</a>
				<ul class="dropdown">
					<li><a href="registerorphan.php">Register orphan</a></li>
					<li><a href="all.php">All orphans</a></li>
					<li><a href="withdonors.php">Orphans with donors</a></li>
					<li><a href="withoutdonors.php">Orphans without donors</a></li>
				</ul>
			</li>	
			<li><a href="bydistrict.php">Orphans by district</a></li>
			<li><a href="districts.php">Districts</a></li>
			<li class="droppar"><a href="#">Users</a>
				<ul class="dropdown">
					<li><a href="users.php">Users</a></li>
					<li><a href="createuser.php">Create users</a></li>
				</ul>
			</li>
			<li class="droppar"><a href="#">Stipends</a>
				<ul class="dropdown">
					<li><a href="orphanswithstipend.php">Orphans stipend granted</a></li>
					<li><a href="searchorphanwithstipend.php">Search orphan granted stipend</a>
					<li><a href="grantstipend.php">Grant stipend</a> 
				</ul>
			</li>
			<li class="droppar"><a href="#">Donors</a>
				<ul class="dropdown">
					<li><a href="donorslist.php">List of donors</a></li> 
					<li><a href="adddonor.php">Add donor</a>
					<li><a href="allocate-orphan-a-donor.php">Sponsor orphan</a> 
				</ul>
			</li>
			<li class="droppar"><a href="#"><?php echo $_SESSION['fullnames']; ?></a>
				<ul class="dropdown">
					<li><a href="../logout.php">Logout</a></li> 
				</ul>
			</li> 
		</ul>
	</div>
</body>
</html>