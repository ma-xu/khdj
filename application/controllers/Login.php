<?php

class Login extends CI_Controller {

    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('Model_admin');
        //$this->check_login();
       // $this->load->library('session');
        //$this->check_login();
    }
    
    public function index()
    {
        $exist = $this->Model_admin->query_user_exsit($_POST['username'],$_POST['password']);
        if ($exist >= 1)  {
            $admin = $this->Model_admin->query_name($_POST['username'],$_POST['password']);
            $adminInfo = array(
                'username'  => $admin->username,
                'name'     => $admin->name
            );

            $this->session->set_userdata($adminInfo);
            $data['name'] = $admin->name;
            $this->load->helper('url');
            $this->load->view('main',$data);
        } 
        else
        {
            $this->load->helper('url');
            $this->load->view('index');
        }   
    }
    
    function signout(){
        $array_items = array('username', 'name');
        $this->session->unset_userdata($array_items);
        $this->load->helper('url');
        $this->load->view('index');  
    }
    
     public function check_login(){
        $session_data = $this->session->userdata('name');
        if(!$session_data){
            $url = "/demo";  
            echo "<script language='javascript' type='text/javascript'>";  
            echo "window.location.href='$url'";  
            echo "</script>";
            exit;
        }
    }
    
}