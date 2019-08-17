<div class="container page-content">
    <div class="row">
<?php

ob_end_clean();
ob_start();

header('Content-type: image/jpeg');
$_GET['email'] = 22;//online 8
if(isset($_GET['email'])){
    $id = $_GET['email'];
    //$result = Users::get_user_data($id);
    //$email = $result['email'];
    create_image_email($id);
}else{
    $email = "No email specified";
}

//$email_length = strlen($email);
//$font_size = 4;
//$image_height = imagefontheight($font_size);
//$image_width = imagefontwidth($font_size) * $email_length;

//$image = imagecreate($image_width, $image_height);

//imagecolorallocate($image, 255, 255, 255);//white
//$font_color = imagecolorallocate($image, 0, 0, 0);//black

//imagestring($image, $font_size, 0, 0, $email, $font_color);
//imagejpeg($image);

function create_image_email($id){

    $result = Users::get_user_data($id);
    $email = $result['email'];

    $email_length = strlen($email);
    $font_size = 4;
    $image_height = imagefontheight($font_size);
    $image_width = imagefontwidth($font_size) * $email_length;

    $image = imagecreate($image_width, $image_height);

    imagecolorallocate($image, 255, 255, 255);//white
    $font_color = imagecolorallocate($image, 0, 0, 0);//black

    imagestring($image, $font_size, 0, 0, $email, $font_color);
    return imagejpeg($image);
}
?>
    </div>
</div>