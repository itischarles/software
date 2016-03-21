<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author itischarles
 */

//require_once (APPPATH).'controllers/CronJobs.php';

class MY_Controller extends CI_Controller {
    
     var $updateTime = '';
    // var $current_userID = 0;
     
    
    function __construct() {
        parent::__construct();
        
        date_default_timezone_set('Europe/London');
        
        $this->updateTime = date('Y-m-d H:m:s', strtotime('now'));
      

    }
    
    
    
    
    function _getCurrentUserID(){
	return $this->session->userdata('userID');
    }
  
  
    
    function _getCurrentUserBaseUrl(){	
	return  $this->session->userdata('userBaseUrl');
    }
    
}