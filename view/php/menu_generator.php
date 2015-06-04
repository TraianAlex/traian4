<?php

$menu = menu::init();
$item1 = $menu->addRootItem('item0');
    $item1->addChild('item1-1');//item1-1
    $item1->addChild('a-2015')->addChild('fb2', 'http://localhost/a-2015/fb2/', '_blank');//item1-2//item1-2-1
    $item1->addChild('localhost')->addChild('Photo gallery', 'http://localhost/photo-gallery/public/', '_blank');//item1-3
$menu->addRootItem('item1');//item1
$menu->addRootItem('item2')->addChild('my profile', 'http://www.phpclasses.org/browse/author/916379.html', '_blank');//'item2//
$menu->addRootItem('item3');//item3
$menu->addRootItem('home', 'http://localhost/traian4/new-pdo/users/nologin_area', '_self');//item4
//to remove ITEM  :
/**
 $menu->removeItemByPath('0\1\0');
 OR
 $item1->remove();
**********************************************/
//TO Add css class for MENU,root item,child item :
/**
 $menu->cssClass= "classNames";
 $menu->GetItemByPath('0\1')->cssClass= "classNames";
**********************************************/
$menu->cssClass = "menu";
//TO modify or edit Feature item :
/**
$menu->GetItemByPath('0\0\1')->title = "enter new title";
OR
$item1->title = "enter new title"; 
**********************************************/
if ($menu->save())?>
    <div class='container page-content'>
        <div class='row'>
            The menu was created, Now you can <a href='<?=SITE_ROOT?>/php/menu'>see menu</a>
        </div>
    </div>