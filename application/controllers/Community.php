<?php
class Community extends CI_Controller{
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('Model_district');
        $this->load->model('Model_street');
        $this->load->model('Model_community');
        $this->load->library('session');
    }
    
    public function index()
    {
        
        $this->load->helper('url');
        $data = $this->Model_community->page_all();
        $this->session->set_userdata('conmmunities_count',$data['total_counts']);
        $data['districts'] = $this->Model_district->query_all();
        $data['streets'] = $this->Model_street->query_all();
        $data['choseid1']='';
        $data['choseid2']='';
        $this->load->view('community',$data);
    }
    
    public function filterdistrict()
    {
        $p1 = $this->input->get('p1');
        $this->load->helper('url');
        $districtid=$p1;
        $data=$this->Model_community->getcommunityinfo1_page($districtid);
        $data['streets']=$this->Model_street->getstreetinfo($districtid);
        $data['districts'] = $this->Model_district->query_all();
        $data['choseid1']=$districtid;
        $data['choseid2']='';
        $data['total_counts']=$this->session->userdata('conmmunities_count');
        $this->load->view('community',$data);
    }
    public function filterstreet()
    {
        $p1 = $this->input->get('p1');
        $p2 = $this->input->get('p2');
        //$data['communities']=array();
        $this->load->helper('url');
        //$districtid=$this->input->post('districtid');
        $streetid=$p1;
        $districtid=$p2;
        $data=$this->Model_community->getcommunityinfo2_page($streetid,$districtid);
        $data['streets'] = $this->Model_street->getstreetinfo($districtid);
        $data['districts'] = $this->Model_district->query_all();
        $data['choseid1']=$districtid;
        $data['choseid2']=$streetid;
        $data['total_counts']=$this->session->userdata('conmmunities_count');
        $this->load->view('community',$data);
    }
    
    public function getSearch(){
        $this->load->helper('url');
        $name = $this->input->post('communityName');
        $streetId  =$this->input->post('streetId');
        $districtId=$this->input->post('districtId');
        $data['communities'] = $this->Model_community->getByStreetIdAndName($streetId,$name);
        $data['streets'] = $this->Model_street->query_all();
        $data['districts'] = $this->Model_district->query_all();
        $data['choseid1']=$districtId;
        $data['choseid2']=$streetId;
        $data['links']='';
        $data['total_counts']=$this->session->userdata('conmmunities_count');
        $this->load->view('community',$data);
    }
    
    
    function insertCommunity(){
        $name = $this->input->post('name');
        $streetId  =$this->input->post('streetId');
        $location=$this->input->post('location');
        $count =$this->Model_community->insertCommunity($name,$streetId,$location);
        echo json_encode($count);
    }
    
    function  getById(){
        $id = $this->input->post('id');
        $community=$this->Model_community->getById($id);
        $district = $this->Model_street->getById($community->street);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        $data['community']=$community;
        $data['district']=$district;
        echo json_encode($data);
    }
    
    function updateCommunity(){
        $id = $this->input->post('id');
        $name = $this->input->post('newName');
        $streetId = $this->input->post('streetId');
        $location =$this->input->post('newLocation');
        $count =$this->Model_community->updateCommunity($name,$id,$location,$streetId);
        echo json_encode($count);
    }
    
    function deleteCommunity(){
        $id = $this->input->post('id');
        $count =$this->Model_community->deleteCommunity($id);
        echo json_encode($count);
    }

    function getStreet(){
        $districtid = $this->input->post('districtid');
        $data=$this->Model_street->getstreetname($districtid);
        echo json_encode($data);

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
     * ajax 通过街道id获取社区列表
     * maxu
     * 2017.01.04
     */
    public function getByStreet(){
        $streetId = $this->input->post('streetId');
        $data =$this->Model_community->getByStreet($streetId);
        echo json_encode($data);
    }
    
}

