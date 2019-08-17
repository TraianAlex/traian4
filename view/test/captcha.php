<div class="container page-content">
    <div class="row"><script src="<?=SITE_ROOT?>/js/breadcrumb.js"></script></div><br>
    <div class="row">

<?php
/*
$salt1   = substr(md5(rand()), 0, 5);
$salt2   = substr(md5(rand()), 0, 5);
$result  = PIPHP_CreateCaptcha(26, rand(4,8), '../library/captcha.ttf', '', $salt1, $salt2);
$captcha = $result[0];
$token   = $result[1];
$image   = $result[2];

echo "The Captcha is '$captcha', the token is:<br />";
echo "'$token', and the image is in:<br />$image:<br />";
echo "<img src=\"$image\"><br />";
ob_flush(); flush(); sleep(2); // Wait for image to display

$guess = "letmein";
$test  = PIPHP_CheckCaptcha($guess, $token, $salt1, $salt2);
if ($test == TRUE) echo "Captcha '$guess' passed<br />";
else echo "Captcha '$guess' failed<br />";

$test_c = PIPHP_CheckCaptcha($captcha, $token, $salt1, $salt2);
if ($test_c == TRUE) echo "Captcha '$captcha' passed";
else echo "Captcha '$captcha' failed";
*/
if(check_captcha())
    echo "valid token";
else
    echo "try again";

create_captcha();
/*
 * delete captcha gif older than 24h
 */     
delete_captcha_gif($_SERVER['DOCUMENT_ROOT'].SITE_ROOT.'/gif/');

?>
</div>
</div>
<?php

function check_captcha(){

    if(isset($_POST['captcha'])){
        $test = PIPHP_CheckCaptcha($_POST['captcha'], $_POST['token'], '!*a&K', '.fs£!+');
        if($test){
            unlink($_SESSION['gif']);
            return true;
        }else{
            unlink($_SESSION['gif']);
            return false;
        }
    }else{
        isset($_SESSION['gif']) && !empty($_SESSION['gif']) ? unlink($_SESSION['gif']) : "";
        return false;
    }
}

function create_captcha(){
    
    $result_c = PIPHP_CreateCaptcha(26, 8, APP_PATH.'/library/captcha.ttf', 'gif/', '!*a&K', '.fs£!+');
    $_SESSION['gif'] = $_SERVER['DOCUMENT_ROOT'].SITE_ROOT.'/gif/'.$result_c[1].'.gif';
    echo <<<_END
<img src="$result_c[2]" /><br />
Please enter the word shown<br />
<form method="post" action="http://localhost/traian4/new-pdo/test/captcha">
<input type="hidden" name="token" value="$result_c[1]" />
<input type="text" name="captcha" />
<input type="submit" />
</form>
_END;
}

function delete_captcha_gif($path_captcha_gif){

    $items = new DirectoryIterator($path_captcha_gif);
    $files = new RegexIterator($items, '/\.(?:jpg|png|gif)$/i');

    foreach ($files as $file){
        if(@fileatime($path_captcha_gif . $file) + 3600 < time()){
            unlink($path_captcha_gif.$file);
        }else{
            echo $file.'<br>';
        }
    }
}

function PIPHP_CheckCaptcha($captcha, $token, $salt1, $salt2){
   // Plug-in 34: Check Captcha
   // This plug-in takes a Captcha string as entered by a user,
   // along with a special token and filename to verify the user
   // as human. The plug-in returns TRUE if the Captcha matches,
   // otherwise FALSE. The arguments required are:
   //    $captcha: Captcha as typed by user
   //    $token:   Token supplied by CreateCaptcha
   //    $salt1:   Same as supplied to CreateCaptcha
   //    $salt2:   Same as supplied to CreateCaptcha
   
   return $token == md5("$salt1$captcha$salt2");
}

function PIPHP_CreateCaptcha($size, $length, $font, $folder, $salt1, $salt2){
   // Plug-in 33: Create Captcha
   // This plug-in creates a GIF image containing a word the
   // user must type in to prove they are not a program. The
   // function returns a three element array containing the
   // following:
   //    Element 0: The Captcha word to be entered
   //    Element 1: A unique 32 character token
   //    Element 2: The location of a GIF file with the Captcha
   //               text
   // The function expects a file dictionary.txt to exist in the
   // current folder. This must be a text file of words separated
   // by \r\n carriage return, line feed pairs. The arguments
   // required are:
   //    $size:   Font size for the Captcha
   //    $length: Length of Captcha in letters
   //    $font:   Location of a TrueType font
   //    $folder: Location of a temporary, web-
   //             accessible folder to store the
   //             captcha GIF. Must end with /
   //    $salt1:  A sequence of characters to help
   //             make the Captcha uncrackable
   //    $salt2:  A second sequence to make it even
   //             less crackable

   $file    = file_get_contents(APP_PATH.'/library/dictionary.txt');
   $temps   = explode("\r\n", $file);
   $dict    = array();

   foreach ($temps as $temp)
      if (strlen($temp) == $length)
         $dict[] = $temp;

   $captcha = $dict[rand(0, count($dict) - 1)];
   $token   = md5("$salt1$captcha$salt2");
   $fname   = "$folder" . $token . ".gif";
   PIPHP_GifText($fname, $captcha, $font, $size, "444444", "ffffff", $size / 10, "666666");
   $image   = imagecreatefromgif($fname);
   $image   = PIPHP_ImageAlter($image, 2);
   $image   = PIPHP_ImageAlter($image, 13);
   
   for ($j = 0 ; $j < 3 ; ++$j)
      $image = PIPHP_ImageAlter($image, 3);
   for ($j = 0 ; $j < 2 ; ++$j)
      $image = PIPHP_ImageAlter($image, 5);

   imagegif($image, $fname);
   return array($captcha, $token, $fname);
}

function PIPHP_GifText($file, $text, $font, $size, $fore, $back, $shadow, $shadowcolor){
   // Plug-in 19: Gif Text
   // This plug-in accepts text input and then turns it into
   // a gif image. Various font sizes and effects are available
   // The arguments are:
   //    $file:        The path and file to save the finished gif
   //    $text:        The text to display
   //    $font:        Filename of a TTF font file
   //    $size:        Font size to use
   //    $fore:        The foreground color
   //    $back:        The background color
   //    $shadow:      0 = None, 1 or more = The offset to use
   //    $shadowcolor: The shadow color (if selected)

   $bound  = imagettfbbox($size, 0, $font, $text);
   $width  = $bound[2] + $bound[0] + 6 + $shadow;
   $height = abs($bound[1]) + abs($bound[7]) + 5 + $shadow;
   $image  = imagecreatetruecolor($width, $height);
   $bgcol  = PIPHP_GD_FN1($image, $back);
   $fgcol  = PIPHP_GD_FN1($image, $fore);
   $shcol  = PIPHP_GD_FN1($image, $shadowcolor);
   imagefilledrectangle($image, 0, 0, $width, $height, $bgcol);
   
   if ($shadow > 0) imagettftext($image, $size, 0, $shadow + 2,
      abs($bound[5]) + $shadow + 2, $shcol, $font, $text);
   
   imagettftext($image, $size, 0, 2, abs($bound[5]) + 2, $fgcol,
      $font, $text);
   imagegif($image, $file);
}

function PIPHP_GD_FN1($image, $color){
   return imagecolorallocate($image,
      hexdec(substr($color, 0, 2)),
      hexdec(substr($color, 2, 2)),
      hexdec(substr($color, 4, 2)));
}

function PIPHP_ImageAlter($image, $effect){
   // Plug-in 14: Image Alter
   // This plug-in takes a GD image and modifies it
   // according to the selected effect. The arguments are:
   //    $image:  The image source
   //    $effect: The effect to use between 1 and 14:
   //        1 = Sharpen
   //        2 = Blur
   //        3 = Brighten
   //        4 = Darken
   //        5 = Increase Contrast
   //        6 = Decrease Contrast
   //        7 = Grayscale
   //        8 = Invert
   //        9 = Increase Red
   //       10 = Increase Green
   //       11 = Increase Blue
   //       12 = Edge Detect
   //       13 = Emboss
   //       14 = Sketchify

   switch($effect){
      case 1:  imageconvolution($image, array(array(-1, -1, -1),
                  array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
               break;
      case 2:  imagefilter($image,
                  IMG_FILTER_GAUSSIAN_BLUR); break;
      case 3:  imagefilter($image,
                  IMG_FILTER_BRIGHTNESS, 20); break;
      case 4:  imagefilter($image,
                  IMG_FILTER_BRIGHTNESS, -20); break;
      case 5:  imagefilter($image,
                  IMG_FILTER_CONTRAST, -20); break;
      case 6:  imagefilter($image,
                  IMG_FILTER_CONTRAST, 20); break;
      case 7:  imagefilter($image,
                  IMG_FILTER_GRAYSCALE); break;
      case 8:  imagefilter($image,
                  IMG_FILTER_NEGATE); break;
      case 9:  imagefilter($image,
                  IMG_FILTER_COLORIZE, 128, 0, 0, 50); break;
      case 10: imagefilter($image,
                  IMG_FILTER_COLORIZE, 0, 128, 0, 50); break;
      case 11: imagefilter($image,
                  IMG_FILTER_COLORIZE, 0, 0, 128, 50); break;
      case 12: imagefilter($image,
                  IMG_FILTER_EDGEDETECT); break;
      case 13: imagefilter($image,
                  IMG_FILTER_EMBOSS); break;
      case 14: imagefilter($image,
                  IMG_FILTER_MEAN_REMOVAL); break;
   }
   
   return $image;
}