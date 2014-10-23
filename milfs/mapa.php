<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Display latitude longitude on marker movement</title>

<script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>

<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" />
<style>
  body { margin:0; padding:0; }
  #map {width: 100%;height: 280px;}
</style>
</head>
<body onload="javascript:window.parent.document.getElementById('<?php echo $_REQUEST[id]?>').value= '';">



<div id='map'></div>
<script type='text/javascript'>
 
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position){
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      });
 
      
/*      var map = L.map('map')
 
      L.tileLayer('http://{s}.tile.cloudmade.com/1cc75fcc8e2243d1b2f6aab1e5850be1/998/256/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
      maxZoom: 18
      }).addTo(map);
   */   
   //   map.locate({setView: true, maxZoom: 16});
 
   /*   function onLocationFound(e) {
        var radius = e.accuracy / 2;
 
        L.marker(e.latlng).addTo(map)
            .bindPopup("You are within " + radius + " meters from this point").openPopup();
 
        L.circle(e.latlng, radius).addTo(map);
      }
 
      map.on('locationfound', onLocationFound);
 */
  }
 
</script>
<?php 
	if ($_REQUEST[lat] !='') {$lat=$_REQUEST[lat];}else {$lat= "-75.5570125579834";}
	if ($_REQUEST[lon] !='') {$lon=$_REQUEST[lon];}else {$lon= "6.2463742841860";}
	if ($_REQUEST[zoom] !='') {$zoom=$_REQUEST[zoom];}else {$zoom= "16";}
	
 ?>
<script>
 
var map = L.map('map')
   // .setView([<?php echo $lon ?>, <?php echo $lat ?>], <?php echo $zoom ?>);
    .setView([latitude, longitude], <?php echo $zoom ?>);
L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

//var lat = window.parent.document.getElementById('lat');
//var lng = window.parent.document.getElementById('lon');

//var mapa = window.parent.document.getElementById('<?php echo $_REQUEST[id]?>');


var marker = L.marker([<?php echo $lon ?>,<?php echo $lat ?>],{draggable: true}).addTo(map);



// every time the marker is dragged, update the coordinates container
marker.on('dragend', ondragend);

// Set the initial marker coordinate on load.
ondragend();


function ondragend() {
    var m = marker.getLatLng();
    var z = map.getZoom();

   // lat.value= m.lat;
   // lng.value= m.lng;
    //mapa.value= m.lng+' '+m.lat+' '+z;
    window.parent.document.getElementById('<?php echo $_REQUEST[id]?>').value= m.lng+' '+m.lat+' '+z;
}
</script>


</body>
</html>