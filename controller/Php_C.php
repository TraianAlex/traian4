<?php

class Php_C extends Controller{
    
    protected function main(){
        $this->model('PHP');
    }

    public function index() {
        URL::to();
    }
    
    public function youtube_down() {
        $this->view('header');
        $this->view('php/youtube_download');
    }
//exec    
    public function exec_down() {
        try{
            if(isset($_POST['submit']) && $_POST['submit'] == 'Download'){
                $this->valid->validation($_POST);
                $obj = new YouTubeVideoDownloader($_POST['code'], "34");
                //$obj->wgetDownload();
                $obj->setDestination("/video/{$_POST['destination']}/");
                $obj->curlDownload();
                throw new Exception('Successfully downloaded');
            }
        }catch (Exception $e){
            Errors::handle_error2($e->getMessage(), null);
            exit;
        }
    }
    
    public function spellcheck() {
        
        if(isset($_POST['submit']) && $_POST['submit'] == 'Check'){
            $word = filter_input(INPUT_POST, 'word', FILTER_SANITIZE_STRING);
            $arrData['exist'] = $this->PHP->word_exist($word);
            $arrData['words'] = $this->PHP->extract_dic($word);
            
            $this->view('header');
            $this->view('php/spellchecker', $arrData);
        }else{
            $this->view('header');
            $this->view('php/spellchecker');
        }
    }
    
    public function watermark_done() {
        $source = basename($_SERVER['DOCUMENT_ROOT'].SITE_ROOT.'/img/city.jpg');
        $this->view('header');
        $this->view('php/index', $source);
    }
//exec
    public function watermark() {
        $this->view('header');
        $this->view('php/watermark');
    }
    
    public function shorten_text() {//shorten_text function
        $this->view('header');
        $this->view('php/shorten_text');
    }
/*
 * func CheckLinks, GetLinksFromURL, RelToAbsURL @FIXME
 */
    public function check_site() {
        $this->view('header');
        $this->view('php/up_or_down');
    }
    
    public function get_browser() {
        $this->view('header');
        $this->view('php/get_browser');
    }
    
    public function captcha2() {
        $this->view('header');
        $this->view('php/captcha2');
    }
    
    public function menu_generator() {
        $this->view('header');
        $this->view('php/menu_generator');
    }
    
    public function menu() {
        $this->view('header');
        $this->view('php/menu');
    }
//exec    
    public function delete_menu() {
        if($this->page == 'delete_menu')
            delete_menu();
    }
    
    public function menu_array() {
        $this->view('php/menu_array');
    }
    
    public function login_system() {
        $this->view('header');
        $this->view('php/login_system');
    }

    public function paypal(){
        $this->view('header');
        $this->view('php/paypal');
    }
}