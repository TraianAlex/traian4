<div class="container page-content">
    <div class="row"><script src="<?=SITE_ROOT?>/js/breadcrumb.js"></script></div>
    <div class="row"><br><?php //GvQJbF2CXLQ //bPPLkBN9iHk
    
    echo Errors::show_errors()?>
    <form method="post" action="<?=SITE_ROOT?>/php/exec_down">
        <label for="code">Code:&nbsp;</label><input type="text" name="code" id="code"><br>
        <label for="destination">Destination:&nbsp;</label><input type="text" name="destination" id="destination">
        <input type="submit" name="submit" value="Download">
    </form><br>
        </div>
        <div class="row">
            <?=read_dir(PATH_FILE."/video/");?>
        </div><hr>
        <div class="row">
            <?=read_dir(PATH_FILE."/video/login_system/");?>
        </div>
        <div class="row">
            <?=EmbedYouTubeVideo("1LadAZTjojM", 370, 300, 1, 1, 0);//zend?>
        </div>
</div>
<?php

function read_dir($dir){
        
    $path = str_replace(PATH_FILE, '', $dir);
    if(is_dir($dir)) {
        $dir_array = scandir($dir);
        foreach($dir_array as $file) {
          if(stripos($file, '.') > 0) {
            echo "video filename:  <a href='".SITE_ROOT."$path$file'>{$file}</a><br />";
          }
        }
      }
    }