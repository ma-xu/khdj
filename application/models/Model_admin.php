<?php

class Model_admin extends CI_Model{
    /**
     * 构建admin表 model
     * @author maxu
     */
    public $id;
    public $create_date;
    public $modify_date;
    public $orders;
    public $name;
    public $password;
    public $username;
    
    
    
    
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();  

    } 
    
    /**
     * 查询账号名密码
     * @param type $username
     * @param type $password
     * @return type
     */
    function query_user_exsit($username,$password){
        $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
        $result=$this->db->query($query, array($username,$password));
        $num_rows = $result->num_rows();
        return $num_rows;
        
    }
    
    function query_name($username,$password){
//        $query = "SELECT name FROM admin WHERE username = ? AND password = ?";
//        $result=$this->db->query($query, array($username,$password));
//        $name = $result->row();
//        return $name; 
        
        $query = $this->db->get_where('admin', array('username' => $username,'password'=>$password));
        
        return $query->row();
    }
}

