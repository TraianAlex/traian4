<div class="container page-content">
    <div class="row">
        
        <a href="#" id="get_location">Get location</a>
        <div id="map">
            <iframe id="google_map" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk?output=embed"></iframe>
        </div>
        
        <script src="<?=SITE_ROOT?>/js/modernizr.custom.geo.js"></script>
        <script>
            if(!Modernizr.geolocation){
                alert('Geolocation not suported');
            }else{
                var c = function(pos){
                    var lat = pos.coords.latitude,
                        long = pos.coords.longitude,
                        acc = pos.coords.accuracy,
                        coords = lat + ', ' + long;

                document.getElementById('google_map').setAttribute('src', 'https://maps.google.co.uk/?q=' + coords + '&z=60&output=embed');
                }

                var e = function(error){
                    if(error.code === 1){
                        alert('Unable to get location');
                    }
                    //if(error.code === 3){
                    //   alert('Too long');
                    //}
                } 

                document.getElementById('get_location').onclick = function(){
                    navigator.geolocation.getCurrentPosition(c, e, {
                        enableHighAccuracy: true
                        //maximumAge: 100000
                        //timeout: 1
                    });
                    return false;
                }
            }
        </script>
    </div>
</div>