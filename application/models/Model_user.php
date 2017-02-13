<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_user extends CI_Model{
    //public $id;
    //public $create_date;
    //public $modify_date;
    //public $orders;
    //public $name;
    //public $street;
    
    
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database(); 
        $this->load->library('pagination'); 

    } 
    
    function page_all(){
        $config['base_url']=site_url('User/index');
        $config['total_rows']=$this->db->count_all_results('user');
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(3));
        if($offset>=2)
          $offset=(intval($this->uri->segment(3))-1)*$page_size;

        $this->db->select('user.*,family.name as familyName');
        $this->db->from('user');
        $this->db->join('family', 'user.family = family.id','left');
        $this->db->order_by('family.id','asc');
        $this->db->order_by('id','asc');
        $this->db->limit($page_size,$offset);
        $data['users'] = $this->db->get()->result_array();
        $data['total_counts']=$config['total_rows'];
        return $data;
    } 
    function query_all(){
        $this->db->select('user.*,family.name as familyName');
        $this->db->from('user');
        $this->db->join('family', 'user.family = family.id','left');
        $this->db->order_by('family.id','asc');
        $this->db->order_by('id','asc');
        //$this->db->limit(5);
        $result = $this->db->get()->result_array();
        //var_dump($result);
        return $result;
    } 
    
    
    public function insertUser($name,$sex,$age,$mobile,$familyId,$staffcode,$username,$password){
        $data = array('name' => $name,'sex'=>$sex,'age'=>$age,'mobile'=>$mobile,'family'=>$familyId,'staffcode'=>$staffcode,'username'=>$username,'password'=>$password);
        $this->db->insert('user', $data);
        return $this->db->affected_rows();
    }
    
    public function getById($id){
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->row();
    }
    
    public function updateUser($id,$name,$sex,$age,$mobile,$familyId,$staffcode,$username,$password){
        $data = array('name' => $name,'sex'=>$sex,'age'=>$age,'mobile'=>$mobile,'family'=>$familyId,'staffcode'=>$staffcode,'username'=>$username,'password'=>$password);
        $where = array('id' => $id);
        $this->db->update('user', $data, $where);
        //var_dump($this->db->affected_rows());
        return $this->db->affected_rows();
    }
    
    function deleteUser($id){
        $this->db->where('id',$id);
        $this->db->delete('user');
        //mysql删除返回的是0,CI框架做了改变返回1 -maxu
        return $this->db->affected_rows();
    }
    
    function getByuserName($staffcode){
        $this->db->select('user.*');
        $this->db->from('user');
        if($staffcode!=null && $staffcode!= ""){
            $this->db->like('user.staffcode', $staffcode, 'both');
        }
        
        //$this->db->join('family', 'user.family = family.id','left');
        //$this->db->order_by('family.id','asc');
        $this->db->order_by('user.id','asc');
        //$this->db->limit(5);
        $result = $this->db->get()->result_array();
        //var_dump($result);
        return $result;
    }


    public function getuserinfo($familyId)
    {
        $page_size=6;
        $offset=intval($this->uri->segment(4));
        if($offset>=2)
          $offset=($offset-1)*$page_size;

        $this->db->select('user.*,family.name as familyName');
        $this->db->from('user');
        if($familyId!=null && $familyId!=0){
            $this->db->where('family.id', $familyId);
        } 
        $this->db->join('family', 'user.family = family.id','left');
        $this->db->order_by('family.id','asc');
        $this->db->order_by('id','asc');
        $this->db->limit($page_size,$offset);
        $data['users'] = $this->db->get()->result_array();
        $count = count($data['users']);
        
        $config['base_url']=site_url('User/filterfamily/').$familyId;
        $config['total_rows']=$count;
       
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        return $data;

    } 
    
    /**
     * 手机端通过用户名(手机号)密码登录
     * 马旭
     * @param type $username
     * @param type $password
     * @return type
     */
    public function getByLogin($username,$password){
        //$this->db->select('*');
        //$this->db->from('user');
        //有问题 v``````````````````````l.43t
       // $where = "password= ? AND username= ? OR mobile= ? ";
        //$this->db->where($where);
        //$where = "username='Joe' AND status='boss' OR status='active'";
        //$this->db->where($where);
        //$this->db->where('password',$password);
        $this->db->where('username',$username);
        $this->db->or_where('mobile',$username);
        $this->db->having('password',$password);
        $result['user'] = $this->db->get('user')->row();
       // $this->db->where('password',$password);
        $this->db->where('username',$username);
        $this->db->or_where('mobile',$username);
        $this->db->having('password',$password);
        $result['count'] = $this->db->get('user')->num_rows();
        return $result;
    }
    
    
    
    
}
