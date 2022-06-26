<?php
	error_reporting(1);
	// $conn=mysqli_connect('localhost', 'root', '','id17026581_gpsdata') or die(mysqli_error());

	// // for connection testing
	// if($conn)
	// {
	// 	echo "Connected Successfully";
	// }
	// else{
	// 	echo "Connection Failed";
	// }

	//To be used online on 000Webhostapp
	$servername = "sql211.epizy.com";
	// REPLACE with your Database name
	$dbname = "epiz_32038061_WhereIsMyBus";
	// REPLACE with Database user
	$username = "epiz_32038061";
	// REPLACE with Database user password
	$password = "GHBorhapXM6Cc";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "";

?>
