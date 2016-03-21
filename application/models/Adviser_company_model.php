<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
 * Description of Adviser_company
 *
 * @author itischarles
 */
class Adviser_company_model extends CI_Model {
    
    
      function __construct() {
        parent::__construct();
    }
    
    
    
    /*** ADVISER COMPANY**/
    
     function addNewCompany($content){      
        $this->db->insert('adviser_company',$content);
        return $this->db->insert_id();     
    }
    function updateAdviserCompany($content, $where){  
	$this->db->where($where);
        $this->db->update('adviser_company',$content);
         return $this->db->affected_rows();  
    }
    
    function getFACompanyByID($adviserCompanyID){
	
    }
    
    function getFACompanyByURL($adviserCompanyBaseUrl){
	return  $this->db->where("adviserCompanyBaseUrl = '$adviserCompanyBaseUrl'")
	      ->get('adviser_company')
	      ->row(); 
    }
    
    function listFACompanies($where = false){
	if($where !== false):
	    $this->db->where($where);
	endif;
	return  $this->db
	      ->get('adviser_company')
	      ->result(); 
    }
    
    function searchFinancialAdviserCompanies($where, $limit = 0, $offset=0, $count=false){
	
	if(empty($where)):
	    return false;
	endif;
	
	$filter = implode(" AND ", $where);
//	echo $filter;
//	return false;
	
	//$this->db->join('users', 'users.userID = advisers.users_userID');

	$this->db->where($filter);
	
	if($count === true):	
	    return $this->db->count_all_results("adviser_company");
	endif; 
	
	$this->db->order_by('adviser_company.adviserCompanyID', 'ASC');
	$this->db->limit( $limit,$offset);
        return $this->db->get('adviser_company')->result();
    }
    
    function generateUrl(){
	$lastEntry = 
	     $this->db
	     ->order_by('adviserCompanyID','DESC')
	     ->limit(1)
	     ->get('adviser_company')
	     ->row();        
     return md5(!empty($lastEntry) ? $lastEntry->adviserCompanyID : 0 );
    }
    
    
    
    
    /**############### COMPANY NETWORK********########
     * 
     */
    
     /*** ADVISER COMPANY**/
    
     function addNewCompanyNetwork($content){      
        $this->db->insert('adviserCompanyNetwork',$content);
        return $this->db->insert_id();     
    }
    
    function updateCompanyNetwork($content, $where){  
	$this->db->where($where);
        $this->db->update('adviserCompanyNetwork',$content);
        return $this->db->affected_rows();   
    }
    
    function getCompanyNetworkByID($adviserCompanyNetworkID){
	
    }
    
    function getCompanyNetworkByURL($adviserCompanyBaseUrl){
	return  $this->db->where("adviserCompanyNetworkBaseUrl = '$adviserCompanyBaseUrl'")
	      ->get('adviserCompanyNetwork')
	      ->row(); 
    }
    
    function listCompanyNetworks($where = false){
	if($where !== false):
	    $this->db->where($where);
	endif;
	return  $this->db
	      ->get('adviserCompanyNetwork')
	      ->result(); 
    }
    
    function searchCompanyNetworks($where, $limit = 0, $offset=0, $count=false){
	
	if(empty($where)):
	    return false;
	endif;
	
	$filter = implode(" AND ", $where);
//	echo $filter;
//	return false;
	
	//$this->db->join('users', 'users.userID = advisers.users_userID');

	$this->db->where($filter);
	
	if($count === true):	
	    return $this->db->count_all_results("adviserCompanyNetwork");
	endif; 
	
	//$this->db->order_by('adviser_company.adviserCompanyID', 'ASC');
	$this->db->limit( $limit,$offset);
        return $this->db->get('adviserCompanyNetwork')->result();
    }
    
    function generateComanyNetwrokUrl(){
	$lastEntry = 
	     $this->db
	     ->order_by('adviserCompanyNetworkID','DESC')
	     ->limit(1)
	     ->get('adviserCompanyNetwork')
	     ->row();        
     return md5(!empty($lastEntry) ? $lastEntry->adviserCompanyNetworkID : 0 );
    }
    
    
    
    
    
    
    
    /***########## ADVISER****/
    
    function searchFinancialAdviser($where, $limit = 0, $offset=0, $count=false){
	
	if(empty($where)):
	    return false;
	endif;
	
	$filter = implode(" AND ", $where);
//	echo $filter;
//	return false;
	
	$this->db->join('users', 'users.userID = advisers.users_userID');
	$this->db->join('adviser_company', 'adviser_company.adviserCompanyID = advisers.adviser_companyID');
	
	$this->db->where($filter);
	
	if($count === true):	
	    return $this->db->count_all_results("advisers");
	endif; 
	
	$this->db->order_by('advisers.adviserID', 'ASC');
	$this->db->limit( $limit,$offset);
        return $this->db->get('advisers')->result();
    }
    
    
     function addNewAdviser($content){      
        $this->db->insert('advisers',$content);
        return $this->db->insert_id();     
    }
    
     function updateAdviser($content, $where){
        $this->db->where($where);
        $this->db->update('advisers',$content);
        
        return $this->db->affected_rows();
    }
    
    
    
    function getAdviserDetails_URL($userBaseUrl){
	$this->db->join('users', 'users.userID = advisers.users_userID');
	$this->db->join('adviser_company', 'adviser_company.adviserCompanyID = advisers.adviser_companyID','LEFT');
	return  $this->db->where("users.userBaseUrl = '$userBaseUrl'")
	      ->get('advisers')
	      ->row(); 
    }
    
    
}
