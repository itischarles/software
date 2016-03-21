<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of New_elements
 *
 * @author itischarles
 */
class Elements extends MY_Controller {
    var $user_accessor =''; // to access the user model
     
     var $current_userID;
     var $current_userBaseUrl;
     var $adviser_company_accessor;
  
    function __construct() {
        parent::__construct();
      
        
    $this->user_accessor = new User_Model();        
    $this->adviser_company_accessor = new Adviser_company_model();


    // you need to be authenticated to view this controller
    $this->user_accessor->authenticate($this->session->userdata('userID'));
  
     $this->current_userID = $this->session->userdata('userID');
    
               
    }
    
    
    function index(){
	
    }
    
    
    function addClient(){
	$data['link_title'] = "add"; 
	$data = array();
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('adviser_company/form', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    function addFinancialAdviser(){
	
	$data['link_title'] = "add"; 
	 
	$data['sidebar'] = "elements/elements-sidebar-add";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('adviser_company/adviser-form', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    function addFinancialAdviserCompany(){
	
	if($this->input->post('add_adviser_company')):
	    
            $this->form_validation->set_rules('adviserCompanyName', 'Company Name', 'trim|required|is_unique[adviser_company.adviserCompanyName]');
            $this->form_validation->set_rules('adviserCompanyAddress1', 'Address Line 1', 'trim|required');
       
            $this->form_validation->set_rules('adviserCompanyCity', 'City', 'trim|required');            
            $this->form_validation->set_rules('adviserCompanyCounty', 'County', 'trim|required');
            $this->form_validation->set_rules('adviserCompanyPostcode', 'Postcode', 'trim|required');            
            $this->form_validation->set_rules('adviserCompanyEmail', 'Eamil', 'trim|required|valid_email');
          
             if($this->form_validation->run()):
                    $content['adviserCompanyName'] = $this->input->post('adviserCompanyName');
                    $content['adviserCompanyAddress1'] = $this->input->post('adviserCompanyAddress1');
		    $content['adviserCompanyAddress2'] = $this->input->post('adviserCompanyAddress2');
		    $content['adviserCompanyAddress3'] = $this->input->post('adviserCompanyAddress3');
                    $content['adviserCompanyCity'] = $this->input->post('adviserCompanyCity');
		    $content['adviserCompanyCounty'] = $this->input->post('adviserCompanyCounty');
                    $content['adviserCompanyPostcode'] = $this->input->post('adviserCompanyPostcode');
                    $content['adviserCompanyEmail'] = $this->input->post('adviserCompanyEmail');
		                
                   
                    $content['adviserCompanyBaseUrl']  = $this->adviser_company_accessor->generateUrl();
                    
                   $this->adviser_company_accessor->addNewCompany($content);
                                         
                         $this->session->set_flashdata('message', 'New record added successfully');
                         $this->session->set_flashdata('type', 'flash_success');
                       // redirect(base_url('user/'.$user_userLink)); 
               
            endif;
              
        endif;
	
	
	
	$data['page_title'] = "New Financial Adviser Company";      
	$data['link_title'] = "add";  
	$data['sidebar'] = "elements/elements-sidebar-add";
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('adviser_company/company-form', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    function adduser(){
	$data['link_title'] = "add"; 
	$data['sidebar'] = "elements/elements-sidebar-add";
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('adviser_company/form', $data);
        $this->load->view('templates/footer', $data); 
    }
}
