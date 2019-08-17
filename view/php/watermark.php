<div class="container page-content">
    <div class="row">
<?php

$_GET['source'] = $_SERVER['DOCUMENT_ROOT'].SITE_ROOT.'/img/city.jpg';

if(isset($_GET['source'])){
    $source = $_GET['source'];
    $logo = $_SERVER['DOCUMENT_ROOT'].SITE_ROOT.'/img/bike.png';

    ob_end_clean();
    ob_start();

    header('Content-type: image/jpeg');
    create_watermark($source, $logo);
}
//<img src="watermark.php?source=phone.jpg">
//<img src="<?=APP_PATH/view/php/watermark.php?source=<?=SITE_ROOT/img/city.jpg" alt="">?>
    </div>
</div><?php

function create_watermark($source, $logo){
    $watermark = imagecreatefrompng($logo);
    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);

    $image = imagecreatetruecolor($watermark_width, $watermark_height);
    $image = imagecreatefromjpeg($source);

    $image_size = getimagesize($source);
    $x = $image_size[0] - $watermark_width - 10;
    $y = $image_size[1] - $watermark_height - 10;

    imagecopymerge($image, $watermark, $x, $y, 0, 0, $watermark_width, $watermark_height, 100);//20
    return imagejpeg($image, $source.'watermarked.jpg');
}