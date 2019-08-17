<div class="container page-content">
    <div class="row"><script src="<?=SITE_ROOT?>/js/breadcrumb.js"></script></div><br>
    <div class="row">
<style type="text/css">
.clock-circle {
  width: 180px;
  height: 180px;
  margin: 0 auto;
  position: relative;
  border: 8px solid #fff;
  border-radius: 50%;
  -webkit-box-shadow: 0 1px 8px rgba(34, 34, 34, 0.3),inset 0 1px 8px rgba(34, 34, 34, 0.3);
  box-shadow: 0 1px 8px rgba(34, 34, 34, 0.3),inset 0 1px 8px rgba(34, 34, 34, 0.3);
  background: #4527A0;
}
.clock-face {
  width: 100%;
  height: 100%;
}
.clock-hour{
  width:0;
  height:0;
  position:absolute;
  top:50%;
  left:50%;
  margin:-4px 0 -4px -25%;
  padding:4px 0 4px 25%;
  background:#fff;
  -webkit-transform-origin:100% 50%;
  -ms-transform-origin:100% 50%;
  transform-origin:100% 50%;
  border-radius:4px 0 0 4px;
}
.clock-minute{
  width:0;
  height:0;
  position:absolute;
  top:50%;
  left:50%;
  margin:-40% -3px 0;
  padding:40% 3px 0;
  background:#fff;
  -webkit-transform-origin:50% 100%;
  -ms-transform-origin:50% 100%;
  transform-origin:50% 100%;
  border-radius:3px 3px 0 0;
}
.clock-second{
  width:0;
  height:0;
  position:absolute;
  top:50%;
  left:50%;
  margin:-40% -1px 0 0;
  padding:40% 1px 0;
  background:#fff;
  -webkit-transform-origin:50% 100%;
  -ms-transform-origin:50% 100%;
  transform-origin:50% 100%;
}
.clock-face:after {
    position:absolute;
    top:50%;
    left:50%;
    width:12px;
    height:12px;
    margin:-6px 0 0 -6px;
    background:#fff;
    border-radius:6px;
    content:"";
    display:block;
}
</style>
<div style="background-color: #673AB7;padding: 10px 0 10px 0;">
<div class="clock-circle">
  <div class="clock-face">
   <div id="hour" class="clock-hour"></div>
   <div id="minute" class="clock-minute"></div>
   <div id="second" class="clock-second"></div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    function analogClock(){
}
analogClock.prototype.run = function () {
    var date = new Date();
    var second = date.getSeconds() * 6;
    var minute = date.getMinutes() * 6 + second / 60;
    var hour = ((date.getHours() % 12) / 12) * 360 + 90 + minute / 12;
    jQuery('#hour').css("transform", "rotate(" + hour + "deg)");
    jQuery('#minute').css("transform", "rotate(" + minute + "deg)");
    jQuery('#second').css("transform", "rotate(" + second + "deg)");
};
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
    var analogclock = new analogClock();
    window.setInterval(function(){ 
    analogclock.run(); 
    }, 1000);
});
</script>
</div>
    </div>
</div>