<div class="container page-content">
    <div class="row"><?php

//use WtMenu\Controller\MenuController;

$array_level_one = array(
    'home' => array(
        'name' => 'Label for Home<span class="sr-only">(current)</span>',
        'link' => '#',
    ),
    'contact' => array(
        'name' => 'Label for Contact',
        'link' => '#',
    ),
    'sitemap' => array(
        'name' => 'Label for Sitemap',
        'link' => '#',
    ),
    'othermap' => array(
        'name' => 'Label for Othermap',
        'link' => '#',
    ),
);

$menu_b = new MenuController($array_level_one);
$menu_b->setInit("ul class='nav navbar-nav'");
$menu_b->setItem("li class='dropdown'");?>

    <nav class="navbar navbar-inverse navbar-fixed-top">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" title="CrearStep" href="#">My framework</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><?php
                echo $menu_b->start()->show();?>
                </div>
	</div>
    </nav>    

        <div style="clear:both"><a href="http://carlcheo.com/startcoding"><img src="http://cdn2.carlcheo.com/wp-content/uploads/2014/12/which-programming-language-should-i-learn-first-infographic.png" title="Which Programming Language Should I Learn First?" alt="Which Programming Language Should I Learn First?" width="1340" height="1500" border="0" /></a></div><div>Courtesy of: <a href="http://carlcheo.com/">CarlCheo.Com</a></div>
    </div>
</div>

