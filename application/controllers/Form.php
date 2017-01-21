<?php

class Form extends CI_Controller {

    public function index()
    {
        
        echo $_POST['username'];
        if ($_POST['username'] == "maxu")  {
            $this->load->helper('url');
            $this->load->view('main');
        } 
        else
        {
            
            $this->load->helper('url');
            $this->load->view('welcome_message');
        }


       
    }
}