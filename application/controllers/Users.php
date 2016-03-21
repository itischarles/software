<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Users extends MY_Controller {
    var $user_accessor =''; // to access the user model
     
     var $current_userID;
     var $current_userBaseUrl;
     
  
    function __construct() {
        parent::__construct();
      
        
    $this->user_accessor = new User_Model();        



    // you need to be authenticated to view this controller
    $this->user_accessor->authenticate($this->session->userdata('userID'));
  
     $this->current_userID = $this->session->userdata('userID');
     $this->current_userBaseUrl = $this->session->userdata('userBaseUrl');
  
               
    }
    
    
     // search clients
    function index(){
      
	$names  = ($this->input->get('names') ? $this->input->get('names') : '');
	$user_ref  = ($this->input->get('user_ref') ? $this->input->get('user_ref') : '');

	   $where_search = array();

       if(!empty($names)):
	    $where_search[] = "(users.userFirstName like '%$names%' OR "
		       . "users.userLastName like '%$names%' )";
       endif;
	$per_page  = ($this->input->get('result_per_page')? $this->input->get('result_per_page') : 200);
	
	$offset = ($this->input->get('offset')? $this->input->get('offset') : ''); 
	
	
	
	$config['base_url'] = base_url('users');
	$config['total_rows'] = $this->user_accessor->searchUsers($where_search, 0, 0, $count = true);	
	$config['per_page']         = $per_page;
        $config['num_links']	    = 200; 
        $config['next_link']        = 'Next';
	$config['prev_link']        = 'Prev';
        $config['next_tag_open']    = '<li class="nextPage">';
        $config['next_tag_close']   = '</li>';
        
        $config['prev_tag_open']    = '<li class="prevPage">';
        $config['prev_tag_close']   = '</li>';
        $config['cur_tag_open']     = "<li class='active'><a>";
        $config['cur_tag_close']    = "</a></li>";	
	$config['full_tag_open']    =  '<ul class="pagination">';
	$config['full_tag_close']    = '</ul>';
	$config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['page_query_string'] = TRUE;
	$config['query_string_segment'] = "offset";
	$config['reuse_query_string']  = TRUE;
	
        $this->pagination->initialize($config); 
	
	
	
        
	$data['page_title'] = "Users Overview";      
	$data['link_title'] = "users";          
       
	$data['users'] = $this->user_accessor->searchUsers($where_search, $per_page, $offset);
         
        
        $this->load->view('templates/header', $data);
         $this->load->view('templates/navbar', $data);
        $this->load->view('users/list-users', $data);
        $this->load->view('templates/footer', $data); 
     
    }
    
    
    
    
    function viewUser($userBaseUrl){
	$data['users'] = $users = $this->user_accessor->getUser_customWhere(array('userBaseUrl'=>$userBaseUrl));
         
         if(empty($users)):
             $this->session->set_flashdata('message', 'User Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
	     return false;
        endif;
	
	
	
	$this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('users/view-user', $data);
        $this->load->view('templates/footer', $data); 
	
	
    }
    
    
    
    function addNewUser(){
	
        if($this->input->post('add_user')):
	  
	    
            $this->form_validation->set_rules('userFirstName', 'Name', 'trim|required');
            $this->form_validation->set_rules('userLastName', 'Last Name', 'trim|required');
	    $this->form_validation->set_rules('userAddressLine1', 'Address Line 1', 'trim|required');
            $this->form_validation->set_rules('userCity', 'City', 'trim|required');            
            $this->form_validation->set_rules('userCounty', 'County', 'trim|required');
            $this->form_validation->set_rules('userPostcode', 'Postcode', 'trim|required');            
            $this->form_validation->set_rules('userEmail', 'Eamil', 'trim|required|valid_email');
          
	   $this->form_validation->set_rules('userUsername', 'UserName', 'trim|required|is_unique[users.userUsername]');
	  $this->form_validation->set_rules('userPassword', 'userPassword', 'trim|required');
	  
	    
             if($this->form_validation->run()):
		 
                    $content['userFirstName'] = $this->input->post('userFirstName');
                    $content['userLastName'] = $this->input->post('userLastName');
		    $content['userAddressLine1'] = $this->input->post('userAddressLine1');
		    $content['userAddressLine2'] = $this->input->post('userAddressLine2');
		    $content['userAddressLine3'] = $this->input->post('userAddressLine3');
                    $content['userCity'] = $this->input->post('userCity');
		    $content['userCounty'] = $this->input->post('userCounty');
                    $content['userPostcode'] = $this->input->post('userPostcode');
                    $content['userEmail'] = $this->input->post('userEmail');
		    $content['userTelephone'] = $this->input->post('userTelephone');
                    $content['userMobile'] = $this->input->post('userMobile');
		    $content['userDateCreated'] = changeDateFormat('now', 'Y-m-d');
                    $content['userIsActive'] = 1;
		    $content['userBaseUrl'] = $userBaseUrl = $this->user_accessor->generateUrl();
		   
		    $content['userUsername'] = $this->input->post('userUsername');
		    $content['userPassword'] = $this->user_accessor->_prep_password($this->input->post('userPassword'));
		   
		    $this->user_accessor->addNewUser($content);
		     
                                         
		    $this->session->set_flashdata('message', 'New record added successfully');
		    $this->session->set_flashdata('type', 'flash_success');
		   redirect(base_url('user/'.$userBaseUrl)); 
               
            endif;
              
        endif;
         
         $data['mode'] = "New";
         $data['page_title'] = "New User";
         $data['mode'] = "new";
         
	
	$this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('users/user-form', $data);
        $this->load->view('templates/footer', $data); 
    }
    
      function editUser($userBaseUrl = ""){
	  
	//$userLink = (!empty($userLink) ? $userLink : $this->current_userBaseUrl);
	  
	$data['user'] = $user = $this->user_accessor->getUser_customWhere(array('userBaseUrl'=>$userBaseUrl));
         
         if(empty($user)):
             $this->session->set_flashdata('message', 'User Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
	     return false;
        endif;
	
	
//	if($this->user_accessor->canViewPage($user->userID) === false):
//	    $this->session->set_flashdata('message', 'Sorry you do not have permission to do this!!!');
//            $this->session->set_flashdata('type', 'flash_error');
//            redirect($_SERVER['HTTP_REFERER']); 
//	     return false;
//	endif;
	
	
	 if($this->input->post('update_user')):
	  
	    
            $this->form_validation->set_rules('userFirstName', 'Name', 'trim|required');
            $this->form_validation->set_rules('userLastName', 'Last Name', 'trim|required');
	    $this->form_validation->set_rules('userAddressLine1', 'Address Line 1', 'trim|required');
            $this->form_validation->set_rules('userCity', 'City', 'trim|required');            
            $this->form_validation->set_rules('userCounty', 'County', 'trim|required');
            $this->form_validation->set_rules('userPostcode', 'Postcode', 'trim|required');            
            $this->form_validation->set_rules('userEmail', 'Eamil', 'trim|required|valid_email');
          
//	    $this->form_validation->set_rules('userUsername', 'UserName', 'trim|required|is_unique[users.userUsername]');
//	    $this->form_validation->set_rules('userPassword', 'userPassword', 'trim|required');
	    
	    if($this->input->post('userUsername') != $user->userUsername):
		$is_unique =  '|is_unique[users.userUsername]';
	    else:
		 $is_unique =  '';
	    endif;
	    
             if($this->form_validation->run()):
		 
                    $content['userFirstName'] = $this->input->post('userFirstName');
                    $content['userLastName'] = $this->input->post('userLastName');
		    $content['userAddressLine1'] = $this->input->post('userAddressLine1');
		    $content['userAddressLine2'] = $this->input->post('userAddressLine2');
		    $content['userAddressLine3'] = $this->input->post('userAddressLine3');
                    $content['userCity'] = $this->input->post('userCity');
		    $content['userCounty'] = $this->input->post('userCounty');
                    $content['userPostcode'] = $this->input->post('userPostcode');
                    $content['userEmail'] = $this->input->post('userEmail');
		    $content['userTelephone'] = $this->input->post('userTelephone');
                    $content['userMobile'] = $this->input->post('userMobile');
		   // $content['userDateCreated'] = changeDateFormat('now', 'Y-m-d');
                   // $content['userIsActive'] = 1;
		    //$content['userBaseUrl'] = $userBaseUrl = $this->user_accessor->generateUrl();
		   
		     if($this->input->post('userUsername')):
			$content['userUsername'] = $this->input->post('userUsername');			
		    endif;
		    
		    if($this->input->post('userPassword')):			
			$content['userPassword'] = $this->user_accessor->_prep_password($this->input->post('userPassword'));
		    endif;
		    
		    $this->user_accessor->updateUser($content, array('userID'=>$user->userID));
		     
                                         
		    $this->session->set_flashdata('message', 'New record added successfully');
		    $this->session->set_flashdata('type', 'flash_success');
		   redirect(base_url('user/'.$userBaseUrl)); 
               
            endif;
              
        endif;
         
         //$data['mode'] = "New";
        $data['page_title'] =  ucwords($user->userFirstName." ".$user->userLastName);
         $data['mode'] = "edit";
         
	
	$this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('users/user-form', $data);
        $this->load->view('templates/footer', $data); 
    }
    
   
    function myAccount(){
	
	
	$data['user'] = $user = $this->user_accessor->getUser_customWhere(array('userID'=>  $this->current_userID));
         
        if(empty($user)):
	    redirect(base_url('logout'));
	     return false;
        endif;
	
	if($this->user_accessor->canViewPage($user->userID) === false):
	    $this->session->set_flashdata('message', 'Sorry you do not have permission to do this!!!');
            $this->session->set_flashdata('type', 'flash_error');
            redirect($_SERVER['HTTP_REFERER']); 
	     return false;
	endif;
	
	$data['page_title'] =  ucwords($user->userFirstName." ".$user->userLastName);
       // $data['sub_title'] = "edit";
         
        $secondary_links[] = array('name'=>'Add User','link'=>'user/new');
        $data['secondary_links'] = $secondary_links;
	
	$this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('users/form', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
    
    /**
     * make user inactive
     * @param string $userLink
     * @return boolean
     */
    function deleteUser($userLink){
	$data['user'] = $user = $this->user_accessor->getUser_customWhere(array('user_userLink'=>$userLink));
         
        if(empty($user)):
             $this->session->set_flashdata('message', 'User Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
	     return false;
        endif;
	
	
	if($this->user_accessor->canViewPage($user->userID) === false):
	    $this->session->set_flashdata('message', 'Sorry you do not have permission to do this!!!');
            $this->session->set_flashdata('type', 'flash_error');
            redirect($_SERVER['HTTP_REFERER']); 
	     return false;
	endif;
	
                  
	$content['user_isActive'] = 0;

	 $this->user_accessor->updateUser($content, array('userID'=>$user->userID));


	$this->session->set_flashdata('message', 'user updated Successfully');
	$this->session->set_flashdata('type', 'flash_success');
	redirect(base_url('users')); 

    }
    
}
