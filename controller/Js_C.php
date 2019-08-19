<?php

class Js_C extends Controller
{
    public function index()
    {
        URL::to();
    }

    //func toggletext
    public function toggle_text()
    {
        $this->view('header');
        $this->view('js/toggle_text');
    }

    //func statusmessages
    public function rollover_text()
    {
        $this->view('header');
        $this->view('js/rollover_text');
    }

    //@FIXME
    public function slide_show()
    {
        $this->view('header');
        $this->view('js/slide_show');
    }
    
    public function input_prompt()
    {
        $this->view('header');
        $this->view('js/input_prompt');
    }
    
    public function wordfromroot()
    {
        $this->view('header');
        //$_GET['word'] = 'aba';
        $this->view('js/wordsfromroot', $this->id);
    }
    
    public function delete_confirmation1()
    {
        $this->view('header');
        $this->view('js/delete_confirmation1');
    }
    
    public function add_remove_elements()
    {
        $this->view('header');
        $this->view('js/add_remove_elements');
        $this->view('js/auto_fillin');
        $this->view('js/removing_nodes');
    }
    
    public function bricks()
    {
        $this->view('header');
        $this->view('js/bricks');
    }
    
    public function get_location()
    {
        $this->view('header');
        //$this->view('js/get_location');
        $this->view('js/geo_position_api');
    }
}