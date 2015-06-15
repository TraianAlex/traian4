<?php

class JQuery_C extends Controller{
    
    public function index() {
        URL::to();
    }
    
    public function insert_new_element() {
        $this->view('header');
        $this->view('jquery/insert_element');
    }
    
    public function menu() {
        $this->view('jquery/menu');
    }
    
    //public function tab_system() {
        //$this->view('header');
        //$this->view('jquery/tab_system');
    //}
    
    public function analog_clock() {
        $this->view('header');
        $this->view('jquery/analog_clock');
    }
    
    public function datatable() {
        
        $this->view('header');
        $this->view('jquery/datatable');
    }
}
