<style type="text/css">
  body { height: 100%; margin: 0px; padding: 0px }
  #map { width:600px; height:500px; }
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
//varaibles for map object, geocoder object, array of marker and information window
var map_obj;
var geocoder;
var temp_mark;
var infowindow;

function showmap() {
	//longitude and latitude of Kathmandu, Nepal 
    var lat_lng = new google.maps.LatLng(27.702871,85.318244);
    //options of map
	var map_options = {
       center: lat_lng,
	   zoom: 10,
       mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	//now map should be there 
    map_obj = new google.maps.Map(document.getElementById("map"), map_options);
  }

function show_address_in_map() 
{
	geocoder = new google.maps.Geocoder();
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
		  if (status == google.maps.GeocoderStatus.OK) {
				map_obj.setCenter(results[0].geometry.location);
				//clear the old marker
				if(temp_mark)
					temp_mark.setMap(null);
				//create a new marker on the searched position
				var marker = new google.maps.Marker({
					map: map_obj, 
					position: results[0].geometry.location
				});	
				//assign the marker to another temporaray variable
				temp_mark = marker;
				//now add the info windows
				infowindow = new google.maps.InfoWindow({content: results[0].formatted_address});
				//now add the evenlistenr to market
				google.maps.event.addListener(marker, 'click', function() {
				  infowindow.open(map_obj,marker);
				});
		  } else {
			alert("Google map could not find the address : " + status);
		  }
   });	
   return false;
}

</script>

<body onload="showmap()">
    <div class="container page-content">
        <div class="row">
            <h3>Find location on google map</h3>
            <form method="post" name="mapform" onsubmit="return show_address_in_map();" >
                <strong>Address : </strong><input type="text" name="address" id="address" value="" /> <input name="find" value="Search" type="submit" /> 
            </form>
            <div id="map" ></div>
        </div>
    </div>