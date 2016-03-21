<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wrapper_model
 *manages accesses to the wrapper tables, product, product options and wrapper rules
 * @author itischarles
 */
class Wrapper_model extends CI_Model{
 
     function __construct() {
        parent::__construct();
    }
    
    
    
    function addNewRcord($content){
        
        $this->db->insert('wrappers', $content);
        return $this->db->insert_id();
    }
    
    function updateRecord($content, $where){
        $this->db->where($where);
        $this->db->update('wrappers', $content);
        return $this->db->affected_rows();
    }
    
    function getRecordByWhere($where){
        $this->db->where($where);
        return $this->db->get('wrappers')->row();
    }
    
    
    function getRcordByID($wrapperID){
        $this->db->where(array('wrapperID'=>(int)$wrapperID));
        return $this->db->get('wrappers')->row();
    }

    
     function getRecordByURL($wrapperBaseUrl){
        $this->db->where(array('wrapperBaseUrl'=>$wrapperBaseUrl));
        return $this->db->get('wrappers')->row();
    }
    
    function getDetailsByWhere($where = false){      
       $this->db->join('advisers', 'clients.advisers_adviserID = advisers.adviserID','LEFT');
       $this->db->join('users', 'users.userID = advisers.users_userID', 'LEFT');
       $this->db->join('title', 'clients.title_titleID = title.titleID', 'LEFT');
       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('wrappers')->row();
    }
    
//    function getClientDetailsByID($clientID = 0){      
//       $this->db->join('advisers', 'clients.advisers_adviserID = advisers.adviserID','LEFT');
//       $this->db->join('users', 'users.userID = advisers.users_userID', 'LEFT');
//       $this->db->join('title', 'clients.title_titleID = title.titleID', 'LEFT');
//      
//        $this->db->where('clients.clientID',(int)$clientID);      
//        
//        return $this->db->get('clients')->row();
//    }
    
    
    function listWrappersByWhere($where = false){       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('wrappers')->result();
    }
    
    
    
    /**
     * get the client details and allows for pagination
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @param bol $count if true, it means we want the num_rows
     * @return type
     */
    function searchWrapperDetails($where, $limit = 0, $offset=0, $count=false){
      //  $this->db->join('clients_products','clients_products.clients_clientID = clients.clientID','LEFT');
      //  $this->db->join('products','clients_products.products_productID = products.productID','LEFT');
        
      if(empty($where)):
	    return false;
	endif;
	
	$filter = implode(" AND ", $where);

	$this->db->where($filter);
	
	if($count === true):	
	    return $this->db->count_all_results("wrappers");
	endif;   
	$this->db->group_by('wrappers.wrapperID');
        $this->db->limit( $limit,$offset);
        return $this->db->get('wrappers')->result();
    }
    
    
    /**
     * generate this key which will be used to view the client's profile page as oopose to using ID
     */
    function generateUrl(){
         $lastEntry = 
                $this->db
                ->order_by('wrapperID','DESC')
                ->limit(1)
                ->get('wrappers')
                ->row();        
        return md5(!empty($lastEntry) ? $lastEntry->wrapperID : 0 );
    }
    
    
    
    
    
    /**************************************************************************
     *		    WRAPPER RULES
     **************************************************************************/
  
     function listWrapperRulesByWhere($where){  
	$this->db->join('wrappers', 'wrappers.wrapperID = wrapper_rules.wrappers_wrapperID', 'LEFT');
       
            $this->db->where($where);    
        
        return $this->db->get('wrapper_rules')->result();
    }
    
    
     function AddWrapperRule($content){  
	 $this->db->insert('wrapper_rules', $content);
        return $this->db->insert_id();
    }
    
    
    
    
    
    /*****************************************************************
     *  PRODUCT
     ****************************************************************/
    
     function addNewProduct($content){
        
        $this->db->insert('products', $content);
        return $this->db->insert_id();
    }
    
    function updateProduct($content, $where){
        $this->db->where($where);
        $this->db->update('products', $content);
        return $this->db->affected_rows();
    }
    
    
    
    
}
