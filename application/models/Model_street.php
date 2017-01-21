<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_street extends CI_Model{
    public $id;
    public $create_date;
    public $modify_date;
    public $orders;
    public $name;
    public $district;
    
    
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();  
        $this->load->library('pagination');
        
    } 
    
    function page_all(){
        
        $config['base_url']=site_url('Street/index');
        $config['total_rows']=$this->db->count_all_results('street');
        //$config['total_rows']=100;
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(3));
        if($offset>=2)
          $offset=(intval($this->uri->segment(3))-1)*$page_size;
        //$data['offset']=$offset;
        //$sql="select * from street limit $offset ,$page_size";
        //$res=$this->db->query($sql);
        $this->db->select('street.*,district.name as districtName,district.id as districtId');
        $this->db->from('street');
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('district.id','asc');
        $this->db->order_by('id','asc');
        $this->db->limit($page_size,$offset);
        $data['streets'] = $this->db->get()->result_array();
        $data['total_counts']=$config['total_rows'];
        //return $result;
        //$data['districts']=$res->result();
        return $data;
    }
    
    function query_all(){
        $this->db->select('street.*,district.name as districtName,district.id as districtId');
        $this->db->from('street');
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('district.id','asc');
        $this->db->order_by('id','asc');
        //$this->db->limit($offset,$page_size);
        $result = $this->db->get()->result_array();
        return $result;
    } 
    
    
    public function insertStreet($name,$districtId){
        $data = array('name' => $name,'district'=>$districtId);
        $this->db->insert('street', $data);
        return $this->db->affected_rows();
    }
    
    public function getById($id){
        $query = $this->db->get_where('street', array('id' => $id));
        return $query->row();
    }
    
    public  function updateStreet($name,$id,$districtId){
        $data = array('name' => $name,'district'=>$districtId);
        $where = array('id' => $id);
        $this->db->update('street', $data, $where);
        return $this->db->affected_rows();
    }
    
    function deleteStreet($id){
        $this->db->where('id',$id);
        $this->db->delete('street');
        //mysql删除返回的是0,CI框架做了改变返回1 -maxu
        return $this->db->affected_rows();
    }
    
    function getByDistrictIdAndName($districtId,$name){
        $this->db->select('street.*,district.name as districtName,district.id as districtId');
        $this->db->from('street');
        if($name!=null && $name!= ""){
            $this->db->like('street.name', $name, 'both');
        }
        if($districtId!=null && $districtId!=0){
            $this->db->where('street.district', $districtId );
        } 
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('district.id','asc');
        $this->db->order_by('id','asc');
        $data['streets'] = $this->db->get()->result_array();
        //var_dump($result);
        return $data;
    }
    
    public function getstreetinfo_page($districtId)
    {
     
        $config['base_url']=site_url('Street/filterdistrict/').$districtId;
        $config['total_rows']=$this->db->count_all_results('street');
        //$config['total_rows']=100;
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(4));
        if($offset>=2)
          $offset=(intval($this->uri->segment(4))-1)*$page_size;
        //$data['offset']=$offset;
        //$offset
        $this->db->select('street.*,district.name as districtName,district.id as districtId');
        $this->db->from('street');
        if($districtId!=null && $districtId!=0){
            $this->db->where('street.district', $districtId );
        } 
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('district.id','asc');
        //$this->db->order_by('id','asc');
        $this->db->limit($page_size,$offset);
        $data['streets'] = $this->db->get()->result_array();
        //var_dump($result);
        return $data;

    }
    
    function getBydistrict($districtId){
        $this->db->select('*');
        $this->db->from('street');
        $this->db->where('district', $districtId );
        $result = $this->db->get()->result_array();
        return $result;
    }
    
    

    public function getstreetinfo($districtId)
    {
     
        $this->db->select('street.*,district.name as districtName,district.id as districtId');
        $this->db->from('street');
        if($districtId!=null && $districtId!=0){
            $this->db->where('street.district', $districtId );
        } 
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('district.id','asc');
        //$this->db->order_by('id','asc');
        //$this->db->limit($page_size,$offset);
        $result = $this->db->get()->result_array();
        //var_dump($result);
        return $result;

    } 

    public function getstreetname($id)
    {
        $this->db->select('street.id,street.name');
        $this->db->from('street');
        $this->db->where('street.district',$id);
         //$this->load->database(); 
        /*$sql="select * from street where district=$id ";
        $res=$this->db->query($sql);*/
        //var_dump($res->result());
        //$data['streetinfo']=$this->db->get()->result_array();
        //var_dump($data['streetinfo']);
        //$data['length']=count($data['streetinfo']);
        $data=$this->db->get()->result_array();
        return $data;
    }
    
    
}
