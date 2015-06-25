<?php

class Diverse_C extends Controller{
    
    protected function main(){
        $this->model('Ajax');
    }

    public function index() {
        URL::to();
    }
    
    public function chart_bar() {
        $this->view('header');
        $this->view('diverse/chart_bar');
    }
    
    public function line_chart() {
        $this->view('header');
        $this->view('diverse/line_chart');
    }
    
    public function pie_chart() {
        $this->view('header');
        $this->view('diverse/pie_chart');
    }
    
    public function filepicker() {
        $this->view('header');
        $this->view('diverse/filepicker');
    }

    public function modal(){
        $this->view('header');
        $this->view('diverse/modal');
    }

    public function hexagon(){
        $this->view('header');
        $this->view('diverse/hexagon_trans');
    }

    public function code_edit(){
        $this->view('header');
        $this->view('diverse/code_editor');
    }

    public function manechin(){
        $this->view('header');
        $this->view('diverse/manechin');
    }
}