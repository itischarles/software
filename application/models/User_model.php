<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Description of user_model
 *
 * @author trblap
 */
class User_model extends CI_Model{
 
     function __construct() {
        parent::__construct();
    }
    
 
    
    function getUser_customWhere($where){
       // $this->db->cache_on();
        $this->db->where(array('userIsActive'=>1));
       //  $this->db->where('clientID >',0);
        return $this->db->where($where)
                ->get('users')
                ->row();
    }
    
    function getUser_BaseURL($where){
       // $this->db->cache_on();
        $this->db->where(array('userIsActive'=>1));
       //  $this->db->where('clientID >',0);
        return $this->db->where($where)
                ->get('users')
                ->row();
    }
    
    function listUsers_customWhere($where, $limit = false){
       
         $this->db->where(array('userIsActive'=>1));
        // $this->db->where('clientID >',0);
         $this->db->group_by('userID');
         
         if($limit !== false):
            $this->db->limit($limit);
         endif;
         
        return $this->db->where($where)
                ->get('users')
                ->result();
    }
    
    
    function getUserByID($user_id){
       // $this->db->cache_on();
      
         //$this->db->where('clientID >',0);
       return  $this->db->where(array('userID' => (int)$user_id,                               
                                   'userIsActive'=>1))
                ->get('users')
                ->row(); 
    }
    
    
    function updateUser($content, $where){
        $this->db->where($where);
        $this->db->update('users',$content);
        
        return $this->db->affected_rows();
    }
   
     
    function addNewUser($content){
      
        $this->db->insert('users',$content);
        return $this->db->insert_id();
     
    }
    
    
    /**
     * logig and check if the user exist.
     * get the user by email since email/username is unique and verify the password 
     * e use password_hash function and password_verify function  - - both php functions
     * @param string $username
     * @param string $password
     * @return array
     */
     function login($username, $password){
        // echo $this->_prep_password('precious');
      
            $this->db->where(array('userUsername' => $username,                                 
                                   'userIsActive'=>1));

            $user_details = $this->db->get('users', 1)->row();           
           
            
            if($user_details):               
                //if user does not have code kdon't login  
                if(empty($user_details->userBaseUrl)):                   
                    return false;
                
                elseif(password_verify($password, $user_details->userPassword)):
                    
                    $this->session->set_userdata('userID', $user_details->userID);                  
                    $this->session->set_userdata('userBaseUrl', $user_details->userBaseUrl);
                    return $user_details;
                else:
                    return false;                    
                endif;                 
               
            endif;      
         
            return false;
        }

   
        
  function authenticate($userID = 0){
//      echo "<pre>";print_r($this->uri);
//      echo "</pre>";
         $user_id = (!$userID) ? $this->session->userdata('userID') : $userID;
         
         $session_user_details = $this->getUserByID($user_id);
         
           if(empty($session_user_details)){
                $this->session->set_userdata('uri_string', uri_string());
		//echo base_url();
		//return false;
                redirect(base_url('login'));
                //return false;
                exit();
            }

            return true;
    }
    
    
    function getSessionID(){
	return $this->session->userdata('userID');
    }
    
       
    /**
     * if the user id is same the session user id or the role of this user is admin then he should be
     * able to view the page
     * @param type $userID
     * @return boolean
     */
    function canViewPage($userID){
 
	$sessionID = $this->getSessionID();
	
       $UserDetails = $this->getUser_customWhere(array('userID'=> $userID));
      
       if(empty($UserDetails)):
           return false;
       endif;
      
       // admin has access
       if($UserDetails->roles_roleID == 1):
           return true;
       endif;
       
       // owner has access
       if(($UserDetails->userID == $sessionID)):         
           return true;
       endif;
       
       
       return false;
    }
    
    
        /**
     * get the client details and allows for pagination
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @param bol $count if true, it means we want the num_rows
     * @return type
     */
    function searchUsers($where, $limit = 0, $offset=0, $count=false){
     
	if(empty($where)):
	    return false;
	endif;
	
	$filter = implode(" AND ", $where);

	$this->db->where($filter);
     
	
	if($count === true):	
	    return $this->db->count_all_results("users");
	endif;   
	$this->db->group_by('users.userID');
        $this->db->limit( $limit,$offset);
        return $this->db->get('users')->result();
    }
    
    
    
    function logout(){
        $this->session->unset_userdata('userID');
        $this->session->unset_userdata('userBaseUrl');
//        $this->session->unset_userdata('fname');
//        $this->session->unset_userdata('lname');
       //  $this->session->unset_userdata('uri_string');
        redirect(base_url('login'));
    }
    
    
    /**
     * logout user out without re-directing
     */
    function logout_no_redirect(){
//        $this->session->unset_userdata('userID');
//        $this->session->unset_userdata('userCode');
//        $this->session->unset_userdata('fname');
//        $this->session->unset_userdata('lname');
       // $this->session->unset_userdata('uri_string');
    }
    

    
    /**
     * return a hash of the password
     * @param string $password
     * @return hash
     */
    function _prep_password($password){
        
        return  password_hash($password,PASSWORD_DEFAULT);
              
    }
    
    
    function generateUrl(){
	$lastEntry = 
	     $this->db
	     ->order_by('userID','DESC')
	     ->limit(1)
	     ->get('users')
	     ->row();        
     return md5(!empty($lastEntry) ? $lastEntry->userID : 0 );
    }
    
    
    
    
    /*********LOGIN HISTRY********/
    function getLoginHistory($where){
         $this->db->cache_on();
         $this->db->limit(5);
        
        return $this->db->where($where)
                ->get('audit_logins')
                ->result();
        
    }
    
    
    function addLoginHistory($content){
        $this->db->inser('audit_logins',$content);
        return $this->db->inser_id();
    }
}