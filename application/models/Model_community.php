<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_community extends CI_Model{
    public $id;
    public $create_date;
    public $modify_date;
    public $orders;
    public $name;
    public $street;
    
    
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();  
        $this->load->library('pagination');

    } 

    function page_all(){
        $config['base_url']=site_url('Community/index');
        $config['total_rows']=$this->db->count_all_results('community');
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(3));
        if($offset>=2)
          $offset=(intval($this->uri->segment(3))-1)*$page_size;

        $this->db->select('community.*,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('community');
        $this->db->join('street', 'community.street = street.id','left');
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('community.id','asc');
        $this->db->order_by('id','asc');
        $this->db->limit($page_size,$offset);
        $data['communities'] = $this->db->get()->result_array();
        $data['total_counts']=$config['total_rows'];
        return $data;
        //var_dump($result);

    } 
    
    function query_all(){
        $this->db->select('community.*,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('community');
        $this->db->join('street', 'community.street = street.id','left');
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('community.id','asc');
        $this->db->order_by('id','asc');
        //$this->db->limit(5);
        $result = $this->db->get()->result_array();
        //var_dump($result);
        return $result;
    } 
    
    
    public function insertCommunity($name,$streetId,$location){
        $data = array('name' => $name,'location'=>$location,'street'=>$streetId);
        $this->db->insert('community', $data);
        return $this->db->affected_rows();
    }
    
    public function getById($id){
        $query = $this->db->get_where('community', array('id' => $id));
        return $query->row();
    }
    
    public  function updateCommunity($name,$id,$location,$streetId){
        $data = array('name' => $name,'location'=>$location,'street'=>$streetId);
        $where = array('id' => $id);
        $this->db->update('community', $data, $where);
        //var_dump($this->db->affected_rows());
        return $this->db->affected_rows();
    }
    
    function deleteCommunity($id){
        $this->db->where('id',$id);
        $this->db->delete('community');
        //mysql删除返回的是0,CI框架做了改变返回1 -maxu
        return $this->db->affected_rows();
    }
    
    function getByStreetIdAndName($streetId,$name){
        $this->db->select('community.*,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('community');
        if($name!=null && $name!= ""){
            $this->db->like('community.name', $name, 'both');
        }
        if($streetId!=null && $streetId!=0){
            $this->db->where('community.street', $streetId );
        } 
        $this->db->join('street', 'community.street = street.id','left');
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('community.id','asc');
        $this->db->order_by('id','asc');
        //$this->db->limit(5);
        $result = $this->db->get()->result_array();
        //var_dump($result);
        return $result;
    }

    public function getcommunityname($id)
    {
        $this->db->select('community.id,community.name');
        $this->db->from('community');
        $this->db->where('community.street',$id);
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

    public function getcommunityinfo1_page($districtId)
    {
        $config['base_url']=site_url('Community/filterdistrict/').$districtId;
        $config['total_rows']=$this->db->count_all_results('community');
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(4));
        if($offset>=2)
          $offset=(intval($this->uri->segment(4))-1)*$page_size;

        $this->db->select('community.*,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('community');
        if($districtId!=null && $districtId!=0){
            $this->db->where('street.district', $districtId );
        } 
        $this->db->join('street', 'community.street = street.id','left');
         $this->db->join('district', 'street.district = district.id','left');
         $this->db->order_by('community.id','asc');
         $this->db->limit($page_size,$offset);
        $data['communities'] = $this->db->get()->result_array();
        //var_dump($result);
        return $data;

    } 
    public function getcommunityinfo1($districtId)
    {

        $this->db->select('community.*,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('community');
        if($districtId!=null && $districtId!=0){
            $this->db->where('street.district', $districtId );
        } 
         $this->db->join('street', 'community.street = street.id','left');
         $this->db->join('district', 'street.district = district.id','left');
         $this->db->order_by('community.id','asc');
         //$this->db->limit($page_size,$offset);
        $result = $this->db->get()->result_array();
        //var_dump($result);
        return $result;

    } 
    public function getcommunityinfo2_page($streetId,$districtId)
    {
     
        $config['base_url']=site_url('Community/filterstreet/').$streetId."/".$districtId;
        $config['total_rows']=$this->db->count_all_results('community');
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(5));
        if($offset>=2)
          $offset=(intval($this->uri->segment(5))-1)*$page_size;
        $this->db->select('community.*,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('community');
        if($streetId!=null && $streetId!=0){
            $this->db->where('community.street', $streetId );
        } 
        $this->db->join('street', 'community.street = street.id','left');
         $this->db->join('district', 'street.district = district.id','left');
         $this->db->order_by('community.id','asc');
         $this->db->limit($page_size,$offset);
         $data['communities'] = $this->db->get()->result_array();
        //var_dump($result);
        return $data;

    } 
    
    
      public function getcommunityinfo2($streetId)
    {
     
        $this->db->select('community.*,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('community');
        if($streetId!=null && $streetId!=0){
            $this->db->where('community.street', $streetId );
        } 
         $this->db->join('street', 'community.street = street.id','left');
         $this->db->join('district', 'street.district = district.id','left');
         $this->db->order_by('community.id','asc');
         //$this->db->limit($page_size,$offset);
         $result = $this->db->get()->result_array();
        //var_dump($result);
        return $result;

    } 
    
    
    
    
    
    /**
     * 根据街道id查询社区列表
     * maxu
     * 2017.01.04
     * @param type $districtId
     * @return type
     */
    function getByStreet($streetId){
        $this->db->select('*');
        $this->db->from('community');
        $this->db->where('street', $streetId );
        $result = $this->db->get()->result_array();
        return $result;
    }
    
    
    
    
    
}
