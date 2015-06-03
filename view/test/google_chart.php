<div class="container page-content">
    <div class="row">

<?php // Plug-in 71: Create Google Chart

// This is an executable example with additional code supplied
// To obtain just the plug-ins please click on the Download link

$title   = 'My Favorite Types of Cheese';
$tcolor  = 'FF0000';
$tsize   = '20';
$type    = 'pie3d';
$width   = '570';
$height  = '230';
$bwidth  = NULL;
$labels  = 'Stilton|Brie|Swiss|Cheddar|Edam|Colby|Gorgonzola';
$legends = $labels;
$colors  = 'BD0000,DE6B00,284B89,008951,9D9D9D,A5AB4B,8C70A4,' .
   'FFD200';
$bgfill  = 'EEEEFF';
$border  = '2';
$bcolor  = '444444';
$data    = '14.9,18.7,7.1,47.3,6.0,3.1,2.1';
$result  = PIPHP_CreateGoogleChart($title, $tcolor, $tsize,
   $type, $bwidth, $labels, $legends, $colors, $bgfill,
   $border, $bcolor, $width, $height, $data);

ob_end_clean();
ob_start();
header('Content-type: image/png');
imagepng($result);

function PIPHP_CreateGoogleChart($title, $tcolor, $tsize,
   $type, $bwidth, $labels, $legends, $colors, $bgfill,
   $border, $bcolor, $width, $height, $data)
{
   // Plug-in 71: Create Google Chart
   //
   // This plug-in returns a GD image created using the Google
   // Charts API. It requires the following arguments where
   // those prefaced by (*) can be set to NULL or '' to use
   // default values:
   //
   //    $title:   (*)The title text
   //    $tcolor:  (*)The title color (6 hex digits)
   //    $tsize:   (*)The title font size
   //    $type:    (*)The chart type, out of: line, vbar, hbar,
   //                 gometer, pie, pie3d, venn and radar
   //    $bwidth:  (*)The width of bars in pixels, if bar chart
   //    $labels:  (*)Data labels, separated by | symbols
   //    $legends: (*)Data legends, separated by | symbols
   //    $colors:  (*)Data colors, separated by | symbols
   //    $bgfill:  (*)Background fill color (6 hex digits)
   //    $border:  (*)Border width in pixels
   //    $bcolor:  (*)Border color (6 hex digits)
   //    $width:   The chart width in pixels
   //    $height:  The chart height in pixels
   //    $data:    The data set, separated by commas

   $types = array('line'    => 'lc',
                  'vbar'    => 'bvg',
                  'hbar'    => 'bhg',
                  'gometer' => 'gom',
                  'pie'     => 'p',
                  'pie3d'   => 'p3',
                  'venn'    => 'v',
                  'radar'   => 'r');

   if (!isset($types[$type])) $type = 'pie';

   $tail  = "chtt=" . urlencode($title);
   $tail .= "&cht=$types[$type]";
   $tail .= "&chs=$width" . "x" . "$height";
   $tail .= "&chbh=$bwidth";
   $tail .= "&chxt=x,y";
   $tail .= "&chd=t:$data";

   if ($tcolor)
      if ($tsize) $tail .= "&chts=$tcolor,$tsize";
   if ($labels)   $tail .= "&chl=$labels";
   if ($legends)  $tail .= "&chdl=$legends";
   if ($colors)   $tail .= "&chco=$colors";
   if ($bgfill)   $tail .= "&chf=bg,s,$bgfill";

   $url   = "http://chart.apis.google.com/chart?$tail";

   // Uncomment the line below to return a URL to the chart image
   // return $url;

   $image = imagecreatefrompng($url);

   $w = imagesx($image);
   $h = imagesy($image);
   $image2 = imagecreatetruecolor($w + $border * 2,
      $h + $border * 2);
   $clr = imagecolorallocate($image,
      hexdec(substr($bcolor, 0, 2)),
      hexdec(substr($bcolor, 2, 2)),
      hexdec(substr($bcolor, 4, 2)));
   imagefilledrectangle($image2, 0, 0, $w + $border * 2,
      $h + $border * 2, $clr);
   imagecopy($image2, $image, $border, $border, 0, 0, $w, $h);
   imagedestroy($image);
   return $image2;
}

?>
    </div>
</div>