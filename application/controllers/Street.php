<?php
class Street extends CI_Controller{
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('Model_district');
        $this->load->model('Model_street');
        $this->load->library('session');
    }
    
    public function index()
    {
       
        $this->load->helper('url');
        $data = $this->Model_street->page_all();
        $this->session->set_userdata('streets_count',$data['total_counts']);
        $data['districts'] = $this->Model_district->query_all();
        $data['choseid']='';
       
        $this->load->view('street',$data);
    }
    
    public function filterdistrict()
    {
        $p1 = $this->input->get('p1');
        $this->load->helper('url');
        $districtid=$p1;
        $data=$this->Model_street->getstreetinfo_page($districtid);
        $data['districts'] = $this->Model_district->query_all();
        $data['choseid']=$districtid;
        $data['total_counts']=$this->session->userdata('streets_count');
        $this->load->view('street',$data);
    }
    
    public function getSearch(){
        $this->load->helper('url');
        $name = $this->input->post('streetName');
        $districtId  =$this->input->post('districtId');
        $data= $this->Model_street->getByDistrictIdAndName($districtId,$name);
        //echo json_encode($results); 
        $data['districts'] = $this->Model_district->query_all();
        $data['choseid']=$districtId;
        $data['links']="";
        $data['total_counts']=$this->session->userdata('streets_count');
        $this->load->view('street',$data);
    }
    
    
    function insertStreet(){
        $name = $this->input->post('name');
        $districtId  =$this->input->post('districtId');
        $count =$this->Model_street->insertStreet($name,$districtId);
        echo json_encode($count);
    }
    
    function  getById(){
        $id = $this->input->post('id');
        $district = $this->Model_street->getById($id);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($district);
    }
    
    function updateStreet(){
        $id = $this->input->post('id');
        $name = $this->input->post('newName');
        $districtId = $this->input->post('districtId');
        $count =$this->Model_street->updateStreet($name,$id,$districtId);
        echo json_encode($count);
    }
    
    function deleteStreet(){
        $id = $this->input->post('id');
        $count =$this->Model_street->deleteStreet($id);
        echo json_encode($count);
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
    
    /**
     * ajax根据区id查询街道
     * maxu
     * 2016.01.03
     */
    function getBydistrict(){
        $districtId = $this->input->post('districtId');
        $data =$this->Model_street->getBydistrict($districtId);
        echo json_encode($data);
    }
    
    
}

