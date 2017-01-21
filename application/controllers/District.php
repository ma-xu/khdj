<?php

class District extends CI_Controller {

    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('Model_district');
       // $this->load->library('session');
        //$this->check_login();
    }
    
    public function index()
    {
        $this->load->helper('url');
        $data = $this->Model_district->page_all();
        
        
        
        $this->load->view('district',$data);
    }
    
    public function add(){
        //echo "jin";
        $this->load->helper('url');
        $this->load->view('index');
    }
    
    public function getById(){
        $id = $this->input->post('id');
        $district = $this->Model_district->getById($id);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($district);
    }
    
    public function updateName(){
        $id = $this->input->post('id');
        $name = $this->input->post('newName');
        $count =$this->Model_district->updateById($name,$id);
        echo json_encode($count);
    }
    
    public function insertDistrict(){
        $name = $this->input->post('name');
        $count =$this->Model_district->insertName($name);
        echo json_encode($count);
    }
    
    public function deleteDistrict(){
        $id = $this->input->post('id');
        $count =$this->Model_district->deleteDistrict($id);
        echo json_encode($count);
        //echo json_encode(1);
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