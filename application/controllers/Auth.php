<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author itischarles
 */
class Auth extends MY_Controller{
    
     var $user_accessor =''; // to access the user model
    
    function __construct() {
        parent::__construct();
        
        $this->user_accessor = new User_model();
    }
    
    
    
  
    function index(){
        redirect(base_url());
    }
    
    
    
    function login(){
        
        $data = array();
        
        if($this->input->post('login')):
            
              $this->form_validation->set_rules('email', 'Email', 'required');
              $this->form_validation->set_rules('password', 'Password', 'required');
              $this->form_validation->set_error_delimiters( '<em class="error_text">','</em>' );
              
                if($this->form_validation->run()):
                    $username = $this->input->post('email');
                    $password = $this->input->post('password');
                 
                      if($this->user_accessor->login($username, $password)):
//                            // If requested a page that needed login - take them there!
                            $uri_string = $this->session->userdata('uri_string');
                                         
                            if($uri_string):
                               // echo $uri_string;
                                redirect(base_url().$this->session->userdata('uri_string'));
                            endif;
                            
                            redirect(base_url('dashboard'));
                           
                            exit();
                               
                        else:
			  
                           $data['login_error'] =  'Invalid Username/Password'; 
                       endif;                  
                endif;             
        endif;
        
     
        
        $this->load->view('templates/header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
  
    
    
    
    function logout(){
        $this->user_accessor->logout();
    }
}
