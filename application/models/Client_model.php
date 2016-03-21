<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Client_model
 *
 * @author itischarles
 */
class Client_model  extends CI_Model{
    //put your code here
    
    function __construct() {
        parent::__construct();
    }
    
    
    
    
    
    function addNew($content){
        
        $this->db->insert('clients', $content);
        return $this->db->insert_id();
    }
    
    function updateClient($content, $where){
        $this->db->where($where);
        $this->db->update('clients', $content);
        return $this->db->affected_rows();
    }
    
    function getClientByWhere($where){
        $this->db->where($where);
        return $this->db->get('clients')->row();
    }
    
    
    function getClientByID($clientID){
        $this->db->where(array('clientID'=>(int)$clientID));
        return $this->db->get('clients')->row();
    }

    
     function getClientByURL($clientURL){
	 $this->db->join('title', 'clients.title_titleID = title.titleID', 'LEFT');
        $this->db->where(array('clientBaseUrl'=>$clientURL));
        return $this->db->get('clients')->row();
    }
    
    function getClientDetailsByWhere($where = false){      
       $this->db->join('advisers', 'clients.advisers_adviserID = advisers.adviserID','LEFT');
       $this->db->join('users', 'users.userID = advisers.users_userID', 'LEFT');
       $this->db->join('title', 'clients.title_titleID = title.titleID', 'LEFT');
       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('clients')->row();
    }
    
    function getClientDetailsByID($clientID = 0){      
       $this->db->join('advisers', 'clients.advisers_adviserID = advisers.adviserID','LEFT');
       $this->db->join('users', 'users.userID = advisers.users_userID', 'LEFT');
       $this->db->join('title', 'clients.title_titleID = title.titleID', 'LEFT');
      
        $this->db->where('clients.clientID',(int)$clientID);      
        
        return $this->db->get('clients')->row();
    }
    
    
    function listClientByWhere($where = false){       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('clients')->result();
    }
    
    
    
    /**
     * get the client details and allows for pagination
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @param bol $count if true, it means we want the num_rows
     * @return type
     */
    function searchClientDetails($where, $limit = 0, $offset=0, $count=false){
      //  $this->db->join('clients_products','clients_products.clients_clientID = clients.clientID','LEFT');
      //  $this->db->join('products','clients_products.products_productID = products.productID','LEFT');
        
      if(empty($where)):
	    return false;
	endif;
	
	$filter = implode(" AND ", $where);

	$this->db->where($filter);
	
	if($count === true):	
	    return $this->db->count_all_results("clients");
	endif;   
	$this->db->group_by('clients.clientID');
        $this->db->limit( $limit,$offset);
        return $this->db->get('clients')->result();
    }
    
    
    /**
     * generate this key which will be used to view the client's profile page as oopose to using ID
     */
    function generateUrl(){
         $lastEntry = 
                $this->db
                ->order_by('clientID','DESC')
                ->limit(1)
                ->get('clients')
                ->row();        
        return md5(!empty($lastEntry) ? $lastEntry->clientID : 0 );
    }
    
  
    
}

