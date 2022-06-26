<!doctype html>
<html lang="en">
  <head>  
<!-- CSS only -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous"> **<!-- JavaScript Bundle with Popper -->** <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script> 
  <!-- MDB -->
  <!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"
></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->



 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons -->
    <link href="img/favicon.pgn" rel="icon">
   
    <!-- Libraries CSS links -->
   
    <link href="lib/jcarousel/css/jcarousel.css" rel="stylesheet">
    
    <!-- Main CSS link -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

<!-- Leaflet Stuff -->
	 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
	  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet-src.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.css" />
<script src="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.js"></script>

<script src="http://labs.easyblog.it/maps/leaflet-search/examples/data/restaurant.geojson.js"></script>
	

    

    <title> WhereIsMyBus?</title>
  </head>
 <body>
     
    
    <!-- <body> -->
<!-- //////////////////////////////////// MAIN CODE BELOW ///////////////////////////////////////////////////////////////// -->
<div id="wrapper2">
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">WhereIsMyBus?</a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
	
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Routes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled"
            >Sign Up</a
          >
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
        
    

      <!-- header end -->


      <br>
      
      <!-- OpenStreetMap Here--> 

 <div id = "map" style = "position: fixed;
border: 3px outset #13a215;

  height: 70%;
  width: 100%;">
     
     
 </div>
 
 

   <script>  
   



$(document).ready(function() {

    // show when page load
    toastr.info('Page Loaded!');

});

   var intervall;
   
   window.desktopcheck = function() {
  var check = false;
  if(window.innerWidth >768){
      check=true;
  }
  return check;
}

/// Getting Travelling Distance/////////////////////
var travelDist;
function getRealDist(){
     
       $.ajax({ 
 
         method: "GET", 
         
         url: "OSRMPOSTJSON.php",
 
       }).done(function( datax ) { 
 
         travelDist = $.parseJSON(datax); 
 
        
       });  
       
 } 

 
 //$(document).ready(function(){
 
 //setInterval(getRealDist, 4000);
// })
 
 //////////////////////Getting Travelling Distance End/////////////
  

//Creating custom marker

var busIcon = L.icon({
    iconUrl: 'pngfind.com-google-maps-icon-png-3115976 (1).png',
   // shadowUrl: 'leaf-shadow.png',

    iconSize:     [37,35, 45.15], // size of the icon
  //  shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [0, 0], // point of the icon which will correspond to marker's location
    //shadowAnchor: [4, 62],  // the same for the shadow
     popupAnchor:  [18.675, -0] // point from which the popup should open relative to the iconAnchor
});






//var map = new L.Map('map', {zoom: 15, center: new L.latLng(data[0].loc) });	//set center from first location
var map = L.map('map').setView([-17.88855, 30.91619], 15);

	 L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
   attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
     }).addTo(map);	//base layer
     var marker= L.marker([0, 0]).addTo(map);
    //var  marker = L.marker([0,0], {icon: busIcon}).addTo(map);
    

	var markersLayer = new L.LayerGroup();	//layer contain searched elements
	


	var controlSearch = new L.Control.Search
	({
		position:'topright',		
		layer: markersLayer,
		initial: false,
		zoom: 15,
		marker: false
	});

	map.addControl( controlSearch );





let firsttime = true;
let firstime = true;
let isIt = true;

function getDatah(){
 
if(window.innerHeight < window.innerWidth && firstime==true && window.desktopcheck() == false ){
    alert("Please use Potrait for a better View!");
    firstime=false;
}
 getRealDist();
    
      $.ajax({ 

        method: "GET", 
        
        url: "mysql2java.php",

      }).done(function( data ) { 

        var result= $.parseJSON(data); 
     

        $.each( result, function( key, value ) { 
            
            alert(result);
        
     var latitude = value['latitude'];
    alert(latitude);
         var longitude = value['longitude'];
       var dist = value['dist2dest'];
        var spd = value['speed'];
    var time = (travelDist /1000) / spd ;
  
  var timeinmin = time * 60; 
  var timeinminFxd = timeinmin.toFixed(0);
  
  
 
 
  
 
  /*
      
  
  var datax = [
		{"loc":[latitude,longitude], "title":"Budiriro 4"},
	
	];
         
         
    
   
          
////////////populate map with markers from sample data
	for(i in datax) {
		title = datax[i].title;	//value searched
			loc = datax[i].loc;		//position found
		
		
			
	}  
	marker = new L.Marker(new L.latLng(loc), {title: title} );//se property searched
			
	var popupstring = title + ': ' + timeinminFxd + ' minute(s) away';
	  //marker.bindPopup(popupstring).openPopup();
		//marker.bindPopup('title: '+ title );
	//	markersLayer.addLayer(marker); */

   
          marker.setLatLng([latitude,longitude]);
	  if(firsttime)
	  {
	  map.setView([latitude,longitude],15);
	  firsttime = false;
	  }
	  var popupstring = 'Budiriro 4: ' + timeinminFxd + ' minute(s) away';
	  marker.bindPopup(popupstring).openPopup();
         marker.addTo(map); 
    
    
      
        }); 
      });  
      
}


$(document).ready(function(){

setInterval(getDatah, 2000);
});

          
          
          
               

           

          
       
















	 
	 
	 
	 
//	 var mymap = L.map('mapsss').setView([-17.88855, 30.91619], 15);
//	  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
//     }).addTo(mymap);
   
/*
function getDatah(){
      $.ajax({ 

        method: "GET", 
        
        url: "mysql2java.php",

      }).done(function( data ) { 

        var resulttt= $.parseJSON(data); 

        $.each( resulttt, function( key, value ) { 
          
          var latitude = value['latitude'];
          var longitude = value['longitude'];
          var dist = value['dist2dest'];
          var spd = value['speed'];
          
           
 
 var time = dist / spd ;
  
  var timeinmin = time * 60; 
  var timeinminFxd = timeinmin.toFixed(0);
          
          
          marker.setLatLng([latitude,longitude]);
	  if(firsttime)
	  {
	  mymap.setView([latitude,longitude]);
	  firsttime = false;
	  }
	  var popupstring = timeinminFxd + ' minute(s) away';
	  marker.bindPopup(popupstring).openPopup();
         marker.addTo(mymap); 
          
              }); 

           

          
       }); 
}

$(document).ready(function(){

setInterval(getDatah, 2000);
});*/

	  </script>
	  

  

      
      
      
      
      
      


      <!-- Footer start -->
      <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="copyright text-center">
                <p class="footer-text">
                  &copy; WhereIsMyBus?</p>
                <p class="mb-0">
                  <small>with ❤️ by <a class="footer-name"> ProtaLLC</a></small>
               
              </div>
            </div>
          </div>
        </div>   
      </footer>
      <!-- Footer end -->
    </div>

    



<!-- //////////////////////////////////// MAIN CODE ABOVE ///////////////////////////////////////////////////////////////// -->


    
  </body>
</html>
