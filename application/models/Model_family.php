<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_family extends CI_Model{
    public $id;
    public $create_date;
    public $modify_date;
    public $orders;
    public $name;
    //public $street;
    
    
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->library('pagination');  

    } 
    function page_all(){
        $config['base_url']=site_url('Family/index');
        $config['total_rows']=$this->db->count_all_results('family');
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(3));
        if($offset>=2)
          $offset=(intval($this->uri->segment(3))-1)*$page_size;

        $this->db->select('family.*,community.name as communityName,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('family');
        $this->db->join('community', 'family.community = community.id','left');
        $this->db->join('street', 'community.street = street.id','left');
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('family.id','asc');
        $this->db->order_by('id','asc');
        $this->db->limit($page_size,$offset);
        $data['families'] = $this->db->get()->result_array();
        $data['total_counts']=$config['total_rows'];
        return $data;
    } 
    
    function query_all(){
        $this->db->select('family.*,community.name as communityName,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('family');
        $this->db->join('community', 'family.community = community.id','left');
        $this->db->join('street', 'community.street = street.id','left');
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('family.id','asc');
        $this->db->order_by('id','asc');
        //$this->db->limit(5);
        $result = $this->db->get()->result_array();
        //var_dump($result);
        return $result;
    } 
    
    
    public function insertFamily($code,$name,$location,$communityId){
        $data = array('code'=>$code,'name' => $name,'community'=>$communityId,'location'=>$location);
        $this->db->insert('family', $data);
        return $this->db->affected_rows();
    }
    
    public function getById($id){
        $query = $this->db->get_where('family', array('id' => $id));
        return $query->row();
    }
    
    public  function updateFamily($id,$code,$name,$location,$communityId){
        $data = array('code'=>$code,'name' => $name,'location'=>$location,'community'=>$communityId);
        $where = array('id' => $id);
        $this->db->update('family', $data, $where);
        //var_dump($this->db->affected_rows());
        return $this->db->affected_rows();
    }
    
    function deleteFamily($id){
        $this->db->where('id',$id);
        $this->db->delete('family');
        //mysql删除返回的是0,CI框架做了改变返回1 -maxu
        return $this->db->affected_rows();
    }
    
    function getByCommunityIdAndName($communityId,$name){
        $this->db->select('family.*,community.name as communityName,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('family');
        if($name!=null && $name!= ""){
            $this->db->like('family.name', $name, 'both');
        }
        if($communityId!=null && $communityId!=0){
            $this->db->where('family.community', $communityId );
        } 
        $this->db->join('community', 'family.community = community.id','left');
        $this->db->join('street', 'community.street = street.id','left');
        $this->db->join('district', 'street.district = district.id','left');
        $this->db->order_by('family.id','asc');
        $this->db->order_by('id','asc');
        //$this->db->limit(5);
        $result = $this->db->get()->result_array();
        //var_dump($result);
        return $result;
    }

    public function getfamilyinfo1($districtId)
    {
     
        $config['base_url']=site_url('Family/filterdistrict/').$districtId;
        $config['total_rows']=$this->db->count_all_results('family');
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(4));
        if($offset>=2)
          $offset=(intval($this->uri->segment(4))-1)*$page_size;

        $this->db->select('family.*,community.name as communityName,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('family');
        if($districtId!=null && $districtId!=0){
            $this->db->where('street.district', $districtId );
        } 
         $this->db->join('community', 'family.community = community.id','left');
         $this->db->join('street', 'community.street = street.id','left');
         $this->db->join('district', 'street.district = district.id','left');
         $this->db->order_by('family.id','asc');
         $this->db->limit($page_size,$offset);
        $data['families'] = $this->db->get()->result_array();
        //var_dump($result);
        return $data;

    }

    public function getfamilyinfo2($streetId,$districtId)
    {
        $config['base_url']=site_url('Family/filterstreet/').$streetId."/".$districtId;
        $config['total_rows']=$this->db->count_all_results('family');
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(5));
        if($offset>=2)
          $offset=(intval($this->uri->segment(5))-1)*$page_size;
        $this->db->select('family.*,community.name as communityName,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('family');
        if($streetId!=null && $streetId!=0){
            $this->db->where('community.street', $streetId );
        } 
         $this->db->join('community', 'family.community = community.id','left');
         $this->db->join('street', 'community.street = street.id','left');
         $this->db->join('district', 'street.district = district.id','left');
         $this->db->order_by('family.id','asc');
         $this->db->limit($page_size,$offset);
         $data['families'] = $this->db->get()->result_array();
        return $data;

    } 

    public function getfamilyinfo3($communityId,$streetId,$districtId)
    {
        $config['base_url']=site_url('Family/filtercommunity/').$communityId."/".$streetId."/".$districtId;
        $config['total_rows']=$this->db->count_all_results('family');
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(6));
        if($offset>=2)
          $offset=(intval($this->uri->segment(6))-1)*$page_size;
        $this->db->select('family.*,community.name as communityName,street.name as streetName,street.id as streetId,district.name as districtName');
        $this->db->from('family');
        if($communityId!=null && $communityId!=0){
            $this->db->where('community.id', $communityId );
        } 
         $this->db->join('community', 'family.community = community.id','left');
         $this->db->join('street', 'community.street = street.id','left');
         $this->db->join('district', 'street.district = district.id','left');
         $this->db->order_by('family.id','asc');
         $this->db->limit($page_size,$offset);
         //$result = $this->db->get()->result_array();
        //return $result;
         $data['families'] = $this->db->get()->result_array();
        return $data;

    } 
    
     public function selectUserinfo($familyId){
         $config['base_url']=site_url('Family/choseUser/').$familyId;
        $config['total_rows']=$this->db->count_all_results('family');
        $page_size=6;
        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=intval($this->uri->segment(6));
        if($offset>=2)
          $offset=(intval($this->uri->segment(6))-1)*$page_size;
        $this->db->select('user.*,family.name as familyName');
        $this->db->from('user');
        if($familyId!=null && $familyId!=0){
         $this->db->where('family.id', $familyId );
        }
	$this->db->join('family', 'user.family = family.id','left');
         $this->db->order_by('user.id','asc');
         $this->db->limit($page_size,$offset);
         $data['users'] = $this->db->get()->result_array();
         
        return $data;

    }

    
    public function getByCommunity($communityId){
        $this->db->select('*');
        $this->db->from('family');
        $this->db->where('community', $communityId );
        $result = $this->db->get()->result_array();
        return $result;
    }
    
    public function insertAndGetId($familyName,$communityId,$familyAddress){
        $data = array('name' => $familyName,'community'=>$communityId,'location'=>$familyAddress);
        $this->db->insert('family', $data);
        return $this->db->insert_id();
    }
    
    public function getLocation($communityId){
        $this->db->select('district.name as districtName,street.name as streetName,community.name as communityName');
        $this->db->from('community');
        
        $this->db->where('community.id', $communityId);
      
        $this->db->join('street', 'community.street = street.id','left');
        $this->db->join('district', 'street.district = district.id','left');
        $result = $this->db->get()->row();
        return $result;
    }
    
    function updateCode($code,$familyId){
        $data = array(
            'code' => $code
        );

        $this->db->where('id', $familyId);
        $this->db->update('family', $data);
    }
    
    
}
