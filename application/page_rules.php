<?php
   
/*
 * defaul class and page
 */
    $config_page['default_class'] = 'users';
    $config_page['default_page'] = 'index';
    
//------ REGISTER PAGE NAMES -------------------------------------------------

/*
* a white list with user pages - only validation
*/
    $config_page['all_pages'] = ['index', 'login', 'register', 'log_out', 'forgot_password', 'send_pass',
           'profile', 'personal_data', 'password', 'update_data', 'change_pass', 'oath_ajax_login', 'oath_fb_login',
           'login_area', 'portofolio',
           'watermark', 'watermark_done', 'check_site', 'shorten_text', 'get_browser', 'captcha2', 'menu_generator',
           'menu', 'paypal',
           'spellcheck', 'menu_array', 'youtube_down', 'exec_down', 'login_system',//php
           'delete_menu',
           'toggle_text', 'rollover_text', 'slide_show', 'input_prompt', 'wordfromroot', 'delete_confirmation1',//js
           'add_remove_elements', 'bricks', 'get_location',//js
           'insert_new_element', 'analog_clock', 'tab_system', 'datatable',//jQuery
           //Angular
           'ajax_nav', 'ajax_nav2', 'ajax_loader', 'predict_word', 'post_data', 'post_data_form', 'extract_data_get',
           'extract_data_post', 'chat', 'chat_exec', 'search_flickr', 'search_address', 'tabs',
            //ajax'
           'captcha', 'test', 'google_chart', 'image_email', 'test_pass', 'embed_youtube', 'tutorial',//test
           'chart_bar', 'line_chart', 'pie_chart', 'filepicker',//diverse
           null];
/*
* in this page must log in first
*/
       $config_page['page_login'] = ['login_area', 'profile', 'personal_data', 'password', 'update_data',
           'change_pass', 'chat', 'chat_exec', 'paypal'];
/*
 * if is a condition
 */
       $config_page['aside_left'] = [];

/*
 * include sidebar float right
 */       
       $config_page['sidebar2'] = [];
/*
 * a white list for admin pages
 */
       $config_page['admin'] = ['index', 'admin', 'login_adm', 'users', 'reg_adm', 'profile_adm', 'visitors',
           'test_adm'];
/*
* in this page must log in first
*/
       $config_page['login_admin'] = ['users', 'reg_adm', 'profile_adm', 'visitors', 'test_adm'];
       
//---------REGISTER CLASSES NAMES FROM URL ----------------------------------------------------------------------
       
       $config_class['allowed'] = ['users', 'admins', 'test', 'php', 'js', 'jQuery', 'ajax', 'diverse'];
