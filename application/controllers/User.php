<?php
class User extends CI_Controller{
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('Model_family');
        $this->load->model('Model_user');
        $this->load->library('session');
    }
    
    public function index()
    {
        $this->load->helper('url');
        $data = $this->Model_user->page_all();
        $this->session->set_userdata('users_count',$data['total_counts']);
        $data['families']=$this->Model_family->query_all();
        //var_dump($result);
        $data['choseid']='';
        $this->load->helper('url');
        $this->load->view('user',$data);
    }
    
    public function filterfamily()
    {

        $data['families']=array();
        $this->load->helper('url');
        $familyId=$_GET['p1'];
        $data=$this->Model_user->getuserinfo($familyId);
        $data['total_counts']=$this->session->userdata('users_count');
        $data['families']=$this->Model_family->query_all();
        $data['choseid']=$familyId;
        $this->load->view('user',$data);
    }
    
    
    public function getSearch(){
        $this->load->helper('url');
        $staffcode = $this->input->post('staffcode');
        //$familyId  =$this->input->post('familyId');
        $data['total_counts']=$this->session->userdata('users_count');
        $data['users'] = $this->Model_user->getByuserName($staffcode);
        //echo json_encode($results); 
        $data['families'] = $this->Model_family->query_all();
        //$data['districts'] = $this->Model_district->query_all();
        $data['choseid']='';
        $data['links']='';
        $this->load->view('user',$data);
    }
    
    
    function insertUser(){
        $name = $this->input->post('name');
        $sex  =$this->input->post('sex');
        $age  =$this->input->post('age');
        $mobile  =$this->input->post('mobile');
        $familyId =$this->input->post('familyId');
        $staffcode =$this->input->post('staffcode');
        $username=$name.substr($mobile,-4);
        $password=$mobile;
        $count =$this->Model_user->insertUser($name,$sex,$age,$mobile,$familyId,$staffcode,$username,$password);
        echo json_encode($count);
    }
    
    function  getById(){
        $id = $this->input->post('id');
        $user=$this->Model_user->getById($id);
        //$district = $this->Model_street->getById($community->street);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        //$data['community']=$community;
        $data['user']=$user;
        echo json_encode($data);
    }
    
    function updateUser(){
        $id = $this->input->post('id');
        $name = $this->input->post('newName');
        $sex = $this->input->post('sex');
        $age=$this->input->post('age');
        $mobile = $this->input->post('mobile');
        $familyId = $this->input->post('familyId');
        $staffcode =$this->input->post('staffcode');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $count =$this->Model_user->updateUser($id,$name,$sex,$age,$mobile,$familyId,$staffcode,$username,$password);
        echo json_encode($count);
    }
    
    function deleteUser(){
        $id = $this->input->post('id');
        $count =$this->Model_user->deleteUser($id);
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
    
}

