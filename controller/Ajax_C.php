<?php

class Ajax_C extends Controller{
    
    protected function main(){
        $this->model('Ajax');
    }

    public function index() {
        URL::to(SITE_ROOT);
    }
    
    public function ajax_nav() {
        $this->view('header');
        $this->view('ajax/ajax_nav');
    }
    
    public function ajax_nav2() {
        $this->view('header');
        $this->view('ajax/ajax_nav2');
    }
    
    public function ajax_loader() {
        $this->view('header');
        $this->view('ajax/ajax_loader');
    }
    
    public function predict_word() {//@FIXME sec part
        $this->view('header');
        $this->view('ajax/predict_word');
    }
    
    public function post_data() {

        if ($this->input->exist('text') && $this->input->exist('feedback') && $this->input->exist('v1')){
            $this->valid->validation($_POST);
            $inserted = $this->Ajax->post_data_ajax();
            if($inserted){
                echo 'Data inserted';
            }else{
                echo 'Data insert failed';
            }
        }else{
            $this->view('header');
            $this->view('ajax/post_data');
        }
    }
    
    public function post_data_form() {
        
        if($this->input->exist('name') && $this->input->exist('email') && $this->input->exist('message')){
            try{
                $this->valid->validation($_POST);
                $inserted = $this->Ajax->post_data_form();
            }catch (Exception $e){
                Errors::handle_error2(null, 'Data2 already inserted');
            }
            if($inserted){
                echo 'Data2 inserted';
            }else{
                echo 'Data2 insert failed';
            }
        }else{
            $this->view('header');
            $this->view('ajax/post_data_form');
        }
        
    }
/*
 * ajax autosuggest word
 */   
    public function extract_data_get() {
        
        if(isset($this->id)){
            $search = $this->Ajax->extract($this->id);
            foreach ($search as $row) {
                echo $row['word'].'<br>';
            }
        }
    }
/*
 * not done yet
 */   
    public function extract_data_post() {
        
        if(isset($_POST['search_term']) == true && empty($_POST['search_term']) == false){
            $text = filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_STRING);
            $search = $this->Ajax->extract($text);
            foreach ($search as $row) {
                echo '<li>'.$row['word'].'<li>';
            }
        }
    }
    
    public function chat() {
        
        $this->view('header');
        $this->view('ajax/chat');
    }
/*
 * added if(strlen($message['user_id']) === 10) to name google or fb users with session
 */   
    public function chat_exec() {
         
        if(isset($_POST['method']) === true && empty($_POST['method']) === false){
            $method = trim($_POST['method']);
            if($method === 'fetch'){
                $messages = $this->Ajax->fetchMessages();
                if(empty($messages) === true){
                    echo 'There are currently no messages in the chat';
                }  else {
                    foreach ($messages as $message){?>
                                <div class="message"><?php
                        if(strlen($message['user_id']) === 10){?>
                                    <a href="#"><?=Sessions::get('user')?></a> says:<?php
                        }else{ ?>
                                    <a href="#"><?=$message['username']?></a> says:<?php
                        }?>
                                    <p><?=nl2br($message['message'])?></p>
                                </div><?php                       
                    }
                }
            }else if($method === 'throw' && isset($_POST['message']) === true){
                 $message = trim($_POST['message']);
                 if(empty($message) === false){
                     $arrData = array('user' => $_SESSION['user_id'], 'message' => $message);
                     $this->Ajax->throwMessage($arrData);
                 }
            }
        }
    }
    
    public function search_flickr() {
        
        $this->view('header');
        $this->view('ajax/search_flickr');
        $this->view('ajax/satelite');
    }
    
    public function search_address() {
        
        $this->view('header');
        $this->view('ajax/search_address');
    }
    
    public function tabs() {
        
        $this->view('header');
        $this->view('ajax/right');
    }

}