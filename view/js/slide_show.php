<div class="container page-content">
    <div class="row">
<?php

$images = array('http://localhost/files/file/index.php?pag=album&album=Album%202');

   $style = "'position:absolute; top:10px; left:10px'";
   echo "<img id='PIPHP_SS1' style=$style>";
   echo "<img id='PIPHP_SS2' style=$style>";
   echo PIPHP_SlideShow($images);//$result[1]

?></div>
</div><?php

function PIPHP_SlideShow($images){
   // This plug-in takes an array of URLs containing images
   // and returns the JavaScript required to display them in a
   // slideshow. It requires this argument:
   //    $images: An array of image URLs

   $count = count($images);
   $out   = "<script>images = new Array($count);\n";

   for ($j=0 ; $j < $count ; ++$j)
   {
      $out .= "images[$j] = new Image();";
      $out .= "images[$j].src = '$images[$j]'\n";
   }

   $out .= <<<_END
counter = 0
step    = 4
fade    = 100
delay   = 0
pause   = 250
startup = pause

load('PIPHP_SS1', images[0]);
load('PIPHP_SS2', images[0]);
setInterval('process()', 20);

function process()
{
   if (startup-- > 0) return;

   if (fade == 100)
   {
      if (delay < pause)
      {
         if (delay == 0)
         {
            fade = 0;
            load('PIPHP_SS1', images[counter]);
            opacity('PIPHP_SS1', 100);
            ++counter;

            if (counter == $count) counter = 0;

            load('PIPHP_SS2', images[counter]);
            opacity('PIPHP_SS2', 0);
         }
         ++delay;
      }
      else delay = 0;
   }
   else
   {
      fade += step;
      opacity('PIPHP_SS1', 100 - fade);
      opacity('PIPHP_SS2', fade);
   }
}

function opacity(id, deg)
{
    var object          = $(id).style;
    object.opacity      = (deg/100);
    object.MozOpacity   = (deg/100);
    object.KhtmlOpacity = (deg/100);
    object.filter       = "alpha(opacity = " + deg + ")";
}

function load(id, img)
{
   $(id).src = img.src;
}

function $(id)
{
   return document.getElementById(id)
}

</script>
_END;

   return $out;
}