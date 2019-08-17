<div class="container page-content">
    <div class="row">
        
        <a href="#" id="get_location">Get location</a>
        <div id="map">
            <iframe id="google_map" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk?output=embed"></iframe>
        </div>
        
        <script src="<?=SITE_ROOT?>/js/geoPosition.js"></script>
        <script>
            document.getElementById('get_location').onclick = function(){
                // p : geolocation object
                function success_callback(p){
                    var lat = p.coords.latitude,
                        long = p.coords.longitude,
                        coords = lat + ', ' + long;

                document.getElementById('google_map').setAttribute('src', 'https://maps.google.co.uk/?q=' + coords + '&z=60&output=embed');
                }

                function error_callback(p){
                    alert('Geolocation not suported');
                }
                
                if(geoPosition.init()){  // Geolocation Initialisation
                        geoPosition.getCurrentPosition(success_callback, error_callback, {enableHighAccuracy: true});
                }
                
                return false;
            }
        </script>
        </div>
</div>