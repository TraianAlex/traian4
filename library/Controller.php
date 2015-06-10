<?php

class Controller {

    protected $valid;
    protected $session;
    protected $input;
    protected $route = [];
    protected $page;
    protected $id;

    public function __construct() {
        $this->valid = new Validate();
        $this->session = new Sessions();
        $this->input = new Input();
        $this->route = get_url();
        $this->page = $this->getMethod();
        $this->id = $this->getId();
        if(method_exists($this, "main")) $this->main();
    }
    
    public function index() {
 
        $this->filter_page();
        $this->view('head');
        $this->dispatch();
        $this->view('footer');
        $this->session->delete_session_messages();
    }
    
    protected function view($templateName, $arrPassValue=''){

        $view_path = APP_PATH . '/view/' . $templateName . '.php';
        if(file_exists($view_path)):
            $arrData = isset($arrPassValue) ? $arrPassValue : '';
            include_once($view_path);
        else:
           die($templateName. ' Template Not Found under View Folder');
        endif;
    }

    protected function model($class){

        $model_path = APP_PATH."/model/$class.php";
        file_exists($model_path) ?
            include_once($model_path):
            die($model_path. 'Model Not Found under Model Folder');
        $class = str_replace('/', '', substr($class, strrpos($class, '/')));
        $this->$class = new $class($_POST);
        unset($class);
    }
                
    private function dispatch() {
        
        $class = Registry::setClass();
        $controller = is_subclass_of($class, __CLASS__) && is_a($class, __CLASS__) ?
            Registry::get(): new Users_C();
        $params = $this->route ? array_values($this->route) : [];
        method_exists($controller, $this->page) ? call_user_func_array([$controller, $this->page], $params) : $controller->index();
        //method_exists($controller, $this->page) ? $controller->$this->page() : $controller->index();
    }
    
    private function getMethod(){

        file_exists(APP_PATH.'/application/page_rules.php') ?
            include APP_PATH."/application/page_rules.php": "";
        $method = isset($this->route[1]) ? $this->route[1] : $config_page['default_page'];
        return $this->valid->check($method);
    }

    protected function getId(){
        
        $id = isset($this->route[2]) ? $this->route[2] : null;
        return $this->valid->check($id);
    }
    
    private function filter_page() {
        
        file_exists(APP_PATH.'/application/page_rules.php') ?
            include APP_PATH."/application/page_rules.php": "";
        if(in_array($this->page, $config_page['all_pages'])):
            $this->checkUserPage();
        elseif(in_array($this->page, $config_page['admin'])):
            if($this->route[0] != 'admins' && !in_array($this->page, ['index', 'login_adm'])):
                $this->check_hash();
                $this->session->check_token();
            endif;
            $this->session->set_token();
            $this->checkAdminPage();
        endif;
    }
    
    private function checkUserPage() {

        file_exists(APP_PATH.'/application/page_rules.php') ?
            include APP_PATH."/application/page_rules.php" : "";
        if(!in_array($this->page, $config_page['all_pages']) ||
          (in_array($this->page, $config_page['page_login']) &&
            $this->session->checkUser() === false)): //|| Users_C::check_user() === false)):
            Errors::handle_error2(null,'You must login to see this page.');
            URL::to(SITE_ROOT.'/');
        endif;
        return $this->valid->check($this->page);
    }   
/*
 * check the hash from every get in admin page
 */
    private function check_hash() {

        $h = new Crypt_HMAC(KEY);
        $array = ['class' => $this->route[0],
                  'page' => $this->page,
                    'id' => $this->id,
                     'h' => isset($this->route[3]) ? $this->route[3] : null];
        if ( !$h->verify_parameters( $array ) && DEBUG_MODE === true):
            die( "Dweep! Somebody tampered with our parameters.\n" );
        elseif (!$h->verify_parameters( $array ) && DEBUG_MODE === false):
            URL::to(SITE_ROOT . "/admins");
        endif;
    }
 
    private function checkAdminPage() {

        file_exists(APP_PATH.'/application/page_rules.php') ?
            include APP_PATH."/application/page_rules.php" : "";
        if (!in_array($this->page, $config_page['admin']) ||
           (in_array($this->page, $config_page['login_admin']) &&
            $this->session->checkAdmin() === false)):
            Errors::handle_error2(null,'You must login to see this page.');
        endif;
        return $this->valid->check($this->page);
    }
}