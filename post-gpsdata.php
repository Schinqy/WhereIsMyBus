<?php

/*
  This is used by ESP-01 to send data to the database via 000webhost server
*/

//To be used online on 000Webhostapp
	$servername = "sql211.epizy.com";
	// REPLACE with your Database name
	$dbname = "epiz_32038061_WhereIsMyBus";
	// REPLACE with Database user
	$username = "epiz_32038061";
	// REPLACE with Database user password
	$password = "GHBorhapXM6Cc";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $dist2dest = $latitude = $longitude = $speed = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $dist2dest = test_input($_POST["dist2dest"]);
        $latitude = test_input($_POST["latitude"]);
        $longitude = test_input($_POST["longitude"]);
        $speed = test_input($_POST["speed"]);
       
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO GPSData (dist2dest,latitude,longitude, speed )
        VALUES ('" . $dist2dest . "', '" . $latitude . "', '" . $longitude . "', '" . $speed . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}