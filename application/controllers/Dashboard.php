<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard
 *
 * @author itischarles
 */
class Dashboard  extends MY_Controller{
    
    var $user_accessor =''; // to access the user model
     
    var $current_userID;
    
   function __construct() {
        parent::__construct();
        
        $this->user_accessor = new User_Model();
	

    // you need to be authenticated to view this controller
    $this->user_accessor->authenticate($this->session->userdata('userID'));
     $this->current_userID = $this->session->userdata('userID');
    }


  
   
   
   
   function index(){
     
       $data = array();
       
        $this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
        $this->load->view('dashboard/view', $data);
        $this->load->view('templates/footer', $data); 
   }
   
   
}
