<?php
class Family extends CI_Controller{
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('Model_district');
        $this->load->model('Model_street');
        $this->load->model('Model_community');
        $this->load->model('Model_family');
        $this->load->library('session');
    }
    
    public function index()
    {
        $this->load->helper('url');
        $data = $this->Model_family->page_all();
        $this->session->set_userdata('families_count',$data['total_counts']);
        $data['districts'] = $this->Model_district->query_all();
        $data['streets'] = $this->Model_street->query_all();
        $data['communities']=$this->Model_community->query_all();
        $data['choseid1']='';
        $data['choseid2']='';
        $data['choseid3']='';
        $this->load->view('family',$data);
    }
    
    public function filterdistrict()
    {
        $data['streets']=array();
        $this->load->helper('url');
        $districtid=$p1;
        $data=$this->Model_family->getfamilyinfo1($districtid);
        $data['streets']=$this->Model_street->getstreetinfo($districtid);
        $data['families']=$this->Model_family->getfamilyinfo1($districtid);
        //$streetid=$data['streets'][0]['id'];
        $data['communities']=$this->Model_community->getcommunityinfo1($districtid);
        //$communityid=$data['communities'][0]['id'];
        //$data['families']=$this->Model_family->getfamilyinfo();
        //print_r($data['streets']);
        $data['districts'] = $this->Model_district->query_all();
        $data['total_counts']=$this->session->userdata('families_count');
        $data['choseid1']=$districtid;
        $data['choseid2']='';
        $data['choseid3']='';
        $this->load->view('family',$data);
    }
    public function filterstreet($p1,$p2)
    {
        //$data['communities']=array();
        $this->load->helper('url');
        //$districtid=$this->input->post('districtid');
        $streetid=$_GET['p1'];
        $districtid=$_GET['p2'];
        $data['families']=$this->Model_family->getfamilyinfo2($streetid);
        $data['communities']=$this->Model_community->getcommunityinfo2($streetid);
        $data['streets'] = $this->Model_street->query_all();
        $data['districts'] = $this->Model_district->query_all();
        $data['choseid1']=$districtid;
        $data['choseid2']=$streetid;
        $data['choseid3']='';
        $this->load->view('family',$data);
    }

    public function filtercommunity($p1,$p2,$p3)
    {
       //$data['communities']=array();
        $this->load->helper('url');
        //$districtid=$this->input->post('districtid');
        $streetid=$p1;
        $districtid=$p2;
        $communityid=$p3;
        $data=$this->Model_family->getfamilyinfo3($communityid,$streetid,$districtid);
        $data['communities']=$this->Model_community->getcommunityinfo2($streetid);
        $data['streets'] = $this->Model_street->getstreetinfo($districtid);
        $data['districts'] = $this->Model_district->query_all();
        $data['total_counts']=$this->session->userdata('families_count');
        $data['choseid1']=$districtid;
        $data['choseid2']=$streetid;
        $data['choseid3']=$communityid;
        $this->load->view('family',$data); 
    }
    
    public function getSearch(){
        $this->load->helper('url');
        $name = $this->input->post('familyName');
        $streetId  =$this->input->post('streetId');
        $districtId=$this->input->post('districtId');
        $communityId=$this->input->post('communityId');
        $data['families'] = $this->Model_family->getByCommunityIdAndName($communityId,$name);
        $data['communities']=$this->Model_community->query_all();
        $data['streets'] = $this->Model_street->query_all();
        $data['districts'] = $this->Model_district->query_all();
        $data['total_counts']=$this->session->userdata('families_count');
        $data['choseid1']=$districtId;
        $data['choseid2']=$streetId;
        $data['choseid3']=$communityId;
        $data['links']='';
        $this->load->view('family',$data);
    }
    
    
    function insertFamily(){
        $code = $this->input->post('code');
        $name= $this->input->post('name');
        $location = $this->input->post('location');
        $communityId  =$this->input->post('communityId');
        //$districtId=$this->input->post('');
        $count =$this->Model_family->insertFamily($code,$name,$location,$communityId);
        echo json_encode($count);
    }
    
    function  getById(){
        $id = $this->input->post('id');
        $data['family']=$this->Model_family->getById($id);
        $community=$this->Model_community->getById($data['family']->community);
        $street=$this->Model_street->getById($community->street);
        //$district = $this->Model_street->getById($street->district);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        $data['community']=$community;
        //$data['district']=$district;
        $data['street']=$street;
        echo json_encode($data);
    }
    
    function updateFamily(){
        $id = $this->input->post('id');
        $code = $this->input->post('newCode');
        $name = $this->input->post('newName');
        $communityId = $this->input->post('communityId');
        $location =$this->input->post('newLocation');
        $count =$this->Model_family->updateFamily($id,$code,$name,$location,$communityId);
        echo json_encode($count);
    }
    
    function deleteFamily(){
        $id = $this->input->post('id');
        $count =$this->Model_family->deleteFamily($id);
        echo json_encode($count);
    }

    function getStreet(){
        $districtid = $this->input->post('districtid');
        $data=$this->Model_street->getstreetname($districtid);
        echo json_encode($data);

    }
    function getCommunity(){
        $streetid = $this->input->post('streetid');
        $data=$this->Model_community->getcommunityname($streetid);
        echo json_encode($data);

    }
    function choseUser($familyId){
        $this->load->helper('url');
        $data=$this->Model_family->selectUserinfo($familyId);
        $data['families']=$this->Model_family->query_all();
        $data['choseid']='';
        $data['total_counts']=$this->session->userdata('users_count');
        $this->load->view('user',$data);
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
     * ajax 通过社区id获取家庭列表
     * maxu
     * 2017.01.04
     */
    public function getByCommunity(){
        $communityId = $this->input->post('communityId');
        $data =$this->Model_family->getByCommunity($communityId);
        echo json_encode($data);
    }
    
}

