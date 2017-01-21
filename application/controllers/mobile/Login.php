<?php
/**
 * 手机端登录页面
 * @author maxu
 * @tel 13952522076
 * @date 2017.01.01
 */
class Login extends CI_Controller {

    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('Model_user');
        $this->load->model('Model_district');
        $this->load->model('Model_family');
        $this->load->database();
        $this->load->library('pinyinfirstchar');
        //$this->check_login();
       // $this->load->library('session');
        //$this->check_login();
    }
    
    public function index()
    {
        
        
        $this->load->helper('url');
        $this->load->view('mobile/login');    
    }       
   
    
    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = $this->Model_user->getByLogin($username,$password);
        $user = $data['user'];
        //var_dump($user);
        if($data['count']>0){
            $this->load->helper('url');
            //$this->load->view('mobile/main',$data);
            redirect("https://buluo.qq.com/p/barindex.html?bid=353688");
        }else{
            $this->load->helper('url');
           
            $this->load->view('mobile/login');
        }  
    }
    
    public function reigisterView(){
        $data['districts'] = $this->Model_district->query_all();       
        $this->load->helper('url');
        $this->load->view('mobile/register',$data);
        
        
    }
    
    public function register(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $familyRadio = $this->input->post('family-radio');
        $communityId = $this->input->post('communityId');
        $familyId = $this->input->post('familyId');
        $familyAddress = $this->input->post('familyAddress');
        $familyName = $this->input->post('familyName');
        
//        var_dump($username);
//        var_dump($password);
//        var_dump($name);
//        var_dump($mobile);
//        
        
        
        
        if($familyRadio=='select'){
            
        }
        if($familyRadio=='new'){
//           $this->load->library('pinyinfirstchar');
//        $result = $this->pinyinfirstchar->getFirstchar('哎');
//        var_dump($result);
            $familyId = $this->Model_family->insertAndGetId($familyName,$communityId,$familyAddress);
            $code = $this->createFamilyCode($communityId,$familyId);
            $this->Model_family->updateCode($code,$familyId);
            
        }
        $sex='';$age='';$staffcode='';
        $count =$this->Model_user->insertUser($name,$sex,$age,$mobile,$familyId,$staffcode,$username,$password);
        if($count>0){
            $data['message']="注册成功";
        }
        else{
            $data['message']="注册失败";
        }
        $this->load->helper('url');
        $this->load->view('mobile/login');
        
    }
    
    function createFamilyCode($communityId,$familyId){
        
        $location = $this->Model_family->getLocation($communityId);
        $districtChar = $this->pinyinfirstchar->getFirstchar($location->districtName);
        $streetChar = $this->pinyinfirstchar->getFirstchar($location->streetName);
        $communityChar1 = $this->pinyinfirstchar->getFirstchar($location->communityName);
        //substr("abcdef", -1)
        $new_comName = $location->communityName;
        $new_comName=mb_substr( $new_comName, 1, 1, 'utf-8' ) ;
        $communityChar2 = $this->pinyinfirstchar->getFirstchar($new_comName);
        $number = 1000+$familyId;
        $familyCode = $districtChar.$streetChar.$communityChar1.$communityChar2.$number;
        return $familyCode;
    }
    
    
    
}