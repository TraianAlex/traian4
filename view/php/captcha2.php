<?php

if(!isset($_POST['secure'])){
    $_SESSION['secure'] = rand(1000, 9999);
} else {
   if($_SESSION['secure'] == $_POST['secure']){
       echo 'a match';
   } else {
     echo 'incorect, try again.';
     $_SESSION['secure'] = rand(1000, 9999);
   }
}
$img = create_captcha1($_SESSION['secure']);

?>Please enter the word shown<br />
<img src="<?=$img?>" alt=""><br>
<form method="post" action="http://localhost/traian4/new-pdo/php/captcha2">
<input type="hidden" name="token" value="<?php //$token?>" />
<input type="text" name="secure" />
<input type="submit" />
</form><?php

function create_captcha1($text)
{    
    ob_end_clean();
    ob_start();
    header('Content-type: image/jpeg');
    
    $font_size = 25;

    $image_width = 110;
    $image_height = 40;

    $image = imagecreate($image_width, $image_height);
    imagecolorallocate($image, 255, 255, 255);
    $text_color = imagecolorallocate($image, 0, 0, 0);

    for($x=1; $x<=50; $x++){
        $x1 = rand(1, 100);
        $y1 = rand(1, 100);
        $x2 = rand(1, 100);
        $y2 = rand(1, 100); 
        imageline($image, $x1, $y1, $x2, $y2, $text_color);
    }
    imagettftext($image, $font_size, 0, 15, 30, $text_color, '../library/captcha.ttf', $text);
    imagejpeg($image);
}

