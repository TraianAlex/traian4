<?php

final class Test_C extends Controller
{
    public function index()
    {
        URL::to();
    }

    public function captcha() {
        $this->view('header');
        $this->view('test/captcha');//hash password//captcha
    }
    
    public function test() {
        $this->view('header');
        $this->view('test/test');//env 
    }
    
    public function google_chart() {
        $this->view('header');
        $this->view('test/google_chart');
    }
    
    public function image_email() {
        $this->view('header');
        $this->view('test/generate_image_email');//image email
    }
    
    public function embed_youtube(){
        $this->view('header');
        $this->view('test/embed_youtube');
    }
    
    public function test_pass() {
        $this->view('header');
        $this->view('test/test_pass');
        //$this->view('test/read_meta');
    }
    
    public function tutorial() {
        $this->view('header');
        $this->view('test/tutorial');
    }
}