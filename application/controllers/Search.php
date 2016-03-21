<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Search
 *
 * @author itischarles
 */
class Search extends MY_Controller {
    var $user_accessor =''; // to access the user model
     
     var $current_userID;
     var $current_userBaseUrl;
     
  
    function __construct() {
        parent::__construct();
      
        
    $this->user_accessor = new User_Model();        



    // you need to be authenticated to view this controller
    $this->user_accessor->authenticate($this->session->userdata('userID'));
  
     $this->current_userID = $this->session->userdata('userID');
    
               
    }
    
    
    function index(){
	
	
	$data['page_title'] = "Find Clients";      
	$data['link_title'] = "find";          
       
        
//    
//	$secondary_links[] = array('name'=>'Add New User','link'=>'user/new');
//	
//	$data['secondary_links'] = $secondary_links;

	//$data['users'] = $this->user_accessor->searchUsers($where_search, $per_page, $offset);
         
        
        $this->load->view('templates/header', $data);
         $this->load->view('templates/navbar', $data);
        $this->load->view('search/find-users', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
    
    function client(){
	
	
	$data['page_title'] = "Find Clients";      
	$data['link_title'] = "find";          
       
        
//    
//	$secondary_links[] = array('name'=>'Add New User','link'=>'user/new');
//	
//	$data['secondary_links'] = $secondary_links;

	//$data['users'] = $this->user_accessor->searchUsers($where_search, $per_page, $offset);
         
        
        $this->load->view('templates/header', $data);
         $this->load->view('templates/navbar', $data);
        $this->load->view('search/find-users', $data);
        $this->load->view('templates/footer', $data); 
    }
}
