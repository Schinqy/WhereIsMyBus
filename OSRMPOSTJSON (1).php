
<?php




 require('connection.php');
  $result=mysqli_query($conn, "SELECT * FROM GPSData ORDER BY id DESC LIMIT 1");

if (mysqli_num_rows($result)<1){
     $result = null;
     
   }
   if ($result) {
       
                          
    $roww=mysqli_fetch_array($result);
    $longitude = $roww['longitude'];
      $latitude =  $roww['latitude'];
      
      }
   
$dest = $longitude.','.$latitude;
 $origin =  '31.00825089904016,-17.83756155'; //HIT coordinates
 // origin(actually they are destination) coordinates must be determined depending 
 // kuti bus rakanangepi
 

$conn->close();



   
 

// Initializing curl
$curl = curl_init();
    
// Sending GET request to reqres.in
// server to get JSON data
curl_setopt($curl, CURLOPT_URL, 
    "http://router.project-osrm.org/table/v1/driving/$origin;$dest");
    
//Telling curl to store JSON
// data in a variable instead
// of dumping on screen
curl_setopt($curl, 
    CURLOPT_RETURNTRANSFER, true);
    
// Executing curl
$response = curl_exec($curl);
  
// Checking if any error occurs 
// during request or not
if($e = curl_error($curl)) {
    echo $e;
} else {
      
    // Decoding JSON data
    $decodedData = json_decode($response); 
          //print_r($decodedData);
         // echo $decodedData->sources[0]->distance;
    // Outputing JSON data in
    // Decoded form
   //var_dump($decodedData);
   
   
}
  


 $distReal= $decodedData->sources[0]->distance;
 echo $decodedData->sources[0]->distance;
 // Closing curl
curl_close($curl);
?>
 
 