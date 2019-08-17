<style type="text/css">
.menu li{
    position: relative;
    float:left;
    margin:1px;
    list-style:none;
    background-color: #ccc;
    padding:5px;
    width:100px;
    text-align: center;
    border:1px solid #666
}
.submenu{background-color: #ccc;padding:0px;display:none;position: absolute;left:0px;top:100%}
.menu li:hover > .submenu{display: block;}
.submenu  .submenu{top:0px !important;left:100%}
</style>
<?php

$menu = menu::init();
$output = $menu->ShowSaved();?>

<div class="container page-content">
    <div class="row"><?php
    
echo $output;

if(file_exists(PATH_FILE."/tmp/data.tmp")){
    ?></div><div class="row"><a href='<?=SITE_ROOT?>/php/delete_menu'> delete menu</a></div><?php
}?>

</div>
