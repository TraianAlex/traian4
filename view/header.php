<?php

file_exists(APP_PATH.'/application/page_rules.php') ?
            include APP_PATH."/application/page_rules.php" : print "no file page rules";?>
<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

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
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="<?=SITE_ROOT?>/users/portofolio">Portofolio <span class="sr-only">(current)</span></a></li>
                <?php
        if(isset($_SESSION['user'])){?>
                <li><?=URL::link('users/log_out', 'Log out', 'onclick="logout_all()"')?></li>
                <li><?=URL::link('users/profile', $_SESSION['user'].' Profile')?></li><?php
        }
        if(!isset($_SESSION['user'])){?>
                <li><a class="sign_in" href="<?=SITE_ROOT?>/users">Sign in</a></li><?php
        }
        if (isset($_SESSION ['id']) && $_SESSION ['id'] == sha1(K1 . sha1(session_id() . K1))) {
            $h = new Crypt_HMAC(KEY);?>
               <li><?=URL::xlink('admins', 'users', null, 'Edit')?></li><?php
        }?>
                <li><a href="<?=SITE_ROOT?>/users/login_area">Protected</a></li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">PHP <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="<?=SITE_ROOT?>/php/youtube_down">Youtube Downloader</a></li>
                      <li><a href="<?=SITE_ROOT?>/php/spellcheck">Spellchecker</a></li>
                      <li><a href="<?=SITE_ROOT?>/php/watermark_done">Watermark</a></li>
                      <li><a href="<?=SITE_ROOT?>/php/watermark">Watermark2</a></li>
                      <li><a href="<?=SITE_ROOT?>/php/shorten_text">Shorten text</a></li>
                      <li><a href="<?=SITE_ROOT?>/php/check_site">Up or Down</a></li>
                      <li><a href="<?=SITE_ROOT?>/php/get_browser">Get Browser</a></li>
                      <li><a href="<?=SITE_ROOT?>/php/captcha2">Captcha2</a></li>
                      <li class="divider"></li>
                      <li><a href="<?=SITE_ROOT?>/php/menu_generator">Menu generator</a></li>
                      <li><a href="<?=SITE_ROOT?>/php/menu">Menu</a></li>
                      <li><a href="<?=SITE_ROOT?>/php/menu_array">Menu array</a></li>
                      <li class="divider"></li>
                      <li><a href="<?=SITE_ROOT?>/php/login_system">Login System</a></li>
                      <li><?=URL::link('php/paypal', 'Paypal')?></li>
                    </ul>
                  </li>
    
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">JS <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="<?=SITE_ROOT?>/js/delete_confirmation1">Delete confirmation1</a></li>
                      <li><a href="<?=SITE_ROOT?>/js/add_remove_elements">Add remove elements</a></li>
                      <li><a href="<?=SITE_ROOT?>/js/toggle_text">Toggle text</a></li>
                      <li><a href="<?=SITE_ROOT?>/js/rollover_text">Rollover text</a></li>
                      <li><a href="<?=SITE_ROOT?>/js/slide_show">Slide show</a></li>
                      <li><a href="<?=SITE_ROOT?>/js/input_prompt">Input Prompt</a></li>
                      <li><a href="<?=SITE_ROOT?>/js/wordfromroot">Word from root</a></li>
                      <li><a href="<?=SITE_ROOT?>/js/bricks">Bricks game</a></li>
                      <li class="divider"></li>
                      <li><a href="<?=SITE_ROOT?>/js/get_location">Where I am</a></li>
                    </ul>
                  </li>
                  
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">jQuery <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="<?=SITE_ROOT?>/jQuery/insert_new_element">Insert new element</a></li>
                      <li><a href="<?=SITE_ROOT?>/jQuery/menu">Menu</a></li>
                      <li><a href="<?=PATH?>/view/jquery/tab_system.php">Tab system</a></li>
                      <li><a href="<?=SITE_ROOT?>/jQuery/datatable">Datatable</a></li>
                      <li class="divider"></li>
                      <li><a href="<?=SITE_ROOT?>/jQuery/analog_clock">Analog Clock</a></li>
                    </ul>
                  </li>
                  
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Test <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=SITE_ROOT?>/test/captcha">Captcha</a></li>
                        <li><a href="<?=SITE_ROOT?>/test/test">Test</a></li>
                        <li><a href="<?=SITE_ROOT?>/test/google_chart">Google chart</a></li>
                        <li><a href="<?=SITE_ROOT?>/test/image_email">Image email</a></li>
                        <li><a href="<?=SITE_ROOT?>/test/embed_youtube">Embed Youtube</a></li>
                        <li><a href="<?=SITE_ROOT?>/test/test_pass">Test Pass</a></li>
                      <li class="divider"></li>
                       <li><a href="<?=SITE_ROOT?>/test/tutorial">Tutorial</a></li>
                    </ul>
                  </li>
                  
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ajax <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="<?=SITE_ROOT?>/ajax/ajax_nav">Ajax navigation</a></li>
                      <li><a href="<?=SITE_ROOT?>/ajax/ajax_nav2">Ajax navigation2</a></li>
                      <li><a href="<?=SITE_ROOT?>/ajax/ajax_loader">Ajax loader</a></li>
                      <li><a href="<?=SITE_ROOT?>/ajax/predict_word">Predict Word</a></li>
                      <li><a href="<?=SITE_ROOT?>/ajax/post_data">Post data</a></li>
                      <li><a href="<?=SITE_ROOT?>/ajax/post_data_form">Post data form</a></li>
                      <li class="divider"></li>
                      <li><a href="<?=SITE_ROOT?>/ajax/chat">Chat</a></li>
                      <li><a href="<?=SITE_ROOT?>/ajax/search_flickr">Search Flickr</a></li>
                      <li><a href="<?=SITE_ROOT?>/ajax/search_address">Search Address</a></li>
                      <li><a href="<?=SITE_ROOT?>/ajax/tabs">Tabs</a></li>
                    </ul>
                  </li>
                  
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Diverse <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="<?=SITE_ROOT?>/diverse/chart_bar">Chart Bar</a></li>
                      <li><a href="<?=SITE_ROOT?>/diverse/line_chart">Line Chart</a></li>
                      <li><a href="<?=SITE_ROOT?>/diverse/pie_chart">Pie Chart</a></li>
                      <li class="divider"></li>
                      <li><a href="<?=SITE_ROOT?>/diverse/filepicker">Filepicker</a></li>
                      <li class="divider"></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li>
                  
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!--end container -->
    </nav>
<br><br><br>
<script type="text/javascript">

function GoogleLogout()
  {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
          $('#google_login_box').show();
          $('#google_profile_box').hide();
    });
  }
  
  function FBLogout()
  {
    FB.logout(function(response) {
        $('#fblogin').show();
        $('#fbstatus').hide();
    });
  }

function logout_all(){
    FBLogout();
    GoogleLogout();
}
</script>