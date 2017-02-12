<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_district extends CI_Model{
    public $id;
    public $create_date;
    public $modify_date;
    public $orders;
    public $name;
    
    
    
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database(); 
        $this->load->library('pagination'); 

    } 
    
    function page_all(){
        $config['base_url']=site_url('District/index');
        $config['total_rows']=$this->db->count_all_results('district');
        //$config['total_rows']=100;
        $page_size=5;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(3));
        
        if($offset>=2)
          $offset=($offset-1)*$page_size;
        $sql="select * from district limit $offset ,$page_size";
        $res=$this->db->query($sql);
        $data['districts']=$res->result_array();
        //$query=$this->db->get("district");
        //$result = $query->result_array();
        $data['total_counts']=$config['total_rows'];
        return $data;
    }
    
    function query_all()
    {
        $query=$this->db->get("district");
        $result = $query->result_array();
        return $result;
    }
    
    
    function getById($id){
        $query = $this->db->get_where('district', array('id' => $id));
        
        return $query->row();
    }
    
    function updateById($name,$id){
        $data = array('name' => $name);
        $where = array('id' => $id);
        $this->db->update('district', $data, $where);
        return $this->db->affected_rows();
    }
    
    function insertName($name){
        $data = array('name' => $name);
        $this->db->insert('district', $data);
        return $this->db->affected_rows();
    }
    
    function deleteDistrict($id){
        $this->db->where('id',$id);
        $this->db->delete('district');
        //mysql删除返回的是0,CI框架做了改变返回1 -maxu
        return $this->db->affected_rows();
    }
}