<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "orphans";

$con = mysqli_connect($host, $username, $password, $database);
if($con){
	//echo "Connection established";
}
else{
	echo "Connection failed";
}

?>