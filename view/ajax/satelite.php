<style type="text/css">
  body { height: 100%; margin: 0px; padding: 0px }
  #map { width:500px; height:500px; }
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  function showmap() {
	//longitude and latitude of Kathmandu, Nepal 
    var lat_lng = new google.maps.LatLng(27.702871,85.318244);
    //options of map
	var map_options = {
       center: lat_lng,
	   zoom : 18, //zoom level of the page
       mapTypeId: google.maps.MapTypeId.SATELLITE
    };
	//now map should be there 
    var map = new google.maps.Map(document.getElementById("map"), map_options);
  }

</script>

<body onload="showmap()">
    <div class="container page-content">
        <div class="row">
            <div id="map" ></div>
        </div>
    </div>