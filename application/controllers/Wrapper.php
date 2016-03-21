<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wrapper
 *
 * @author itischarles
 */
class Wrapper extends MY_Controller {
    var $user_accessor =''; // to access the user model
     var $client_accessor = '';
      var $wrapper_accssor = '';
     var $current_userID;
     var $current_userBaseUrl;
    var $product_accessor = '';
  
    function __construct() {
        parent::__construct();
      
        
    $this->user_accessor = new User_Model();        
    $this->client_accessor = new Client_model(); 
    $this->wrapper_accssor = new Wrapper_model();
    $this->product_accessor = new Product_model();


    // you need to be authenticated to view this controller
    $this->user_accessor->authenticate($this->session->userdata('userID'));
  
     $this->current_userID = $this->session->userdata('userID');
     $this->current_userBaseUrl = $this->session->userdata('userBaseUrl');
  
               
    }
    
    
    
    
    function listWrappers(){
	
	$wrapper_name  = ($this->input->get('wrapper_name') ? $this->input->get('wrapper_name') : '');
	$wrapper_ref  = ($this->input->get('wrapper_ref') ? $this->input->get('wrapper_ref') : '');

	   $where_search = array();

       if(!empty($wrapper_name)):
	    $where_search[] = "(wrappers.wrapperName like '$wrapper_name%' )";
       endif;
        if(!empty($wrapper_ref)):
	    $where_search[] = "(wrappers.wrapperRef like '$wrapper_ref%'  )";
       endif;

       $offset = ($this->input->get('offset')? $this->input->get('offset') : ''); 
       $per_page  = ($this->input->get('result_per_page')? $this->input->get('result_per_page') : 200);
	

	
	$config['base_url'] = base_url('wrappers/list-wrappers');
	$config['total_rows'] = $data['db_total_rows'] = $this->wrapper_accssor->searchWrapperDetails($where_search, false, false,true);	
	$config['per_page']         = $per_page;
        $config['num_links']	    = 10; 
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
	
	
	//$data['statuses'] = $this->status_accessor->listStatuses();
	$data['wrappers'] = $this->wrapper_accssor->searchWrapperDetails($where_search, $per_page,$offset);
	
	
	
	$data['page_title'] = "Clients";      
	$data['link_title'] = "setting";  
	
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('wrappers/list-wrappers', $data);
        $this->load->view('templates/footer', $data);
    }
    
    
    
    
    function newWrapper(){
	
	if($this->input->post('add_new_wrapper')):
	  //    
	    
//	    if($this->input->post('adviserCompanyName') != $adviserCompany->adviserCompanyName):
//		$is_unique =  '|is_unique[adviser_company.adviserCompanyName]';
//	    else:
//		 $is_unique =  '';
//	    endif;		
	
           // $this->form_validation->set_rules('adviserCompanyName', 'Company Name', 'trim|required'.$is_unique);
            
	    $this->form_validation->set_rules('wrapper_name', 'Wrapper Name', 'trim|required|is_unique[wrappers.wrapperName]');
	    $this->form_validation->set_rules('Reference', 'Reference', 'trim|required|is_unique[wrappers.wrapperRef]');
	    
	  
             if($this->form_validation->run()):
	
		$content['wrapperName']= $this->input->post('wrapper_name');
		$content['wrapperRef']= $this->input->post('Reference');		
		
		$content['wrapperIsActive'] = 1;
		
		$content['wrapperBaseUrl'] = $wrapperBaseUrl =  $this->wrapper_accssor->generateUrl();
		
		$this->wrapper_accssor->addNewRcord($content);
		
		
		$this->session->set_flashdata('message', 'Record Created');
		$this->session->set_flashdata('type', 'flash_success');
	       redirect(base_url('wrapper/'.$wrapperBaseUrl)); 
               
	     endif;
	
	endif;
	
	$data['page_title'] = "Individual New Wrapper";      
	$data['link_title'] = "setting";  
	 $data['mode'] = "new";  
	
	

	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('wrappers/form-wrapper', $data);
	$this->load->view('templates/footer', $data);
    }
    
    
     function editWrapper($wrapperBaseUrl){
	
	$data['wrapper'] = $wrapper = $this->wrapper_accssor->getRecordByURL($wrapperBaseUrl);
	//print_r($wrapper);
	
	if(empty($wrapper)):	
             $this->session->set_flashdata('message', 'Wrapper Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
            redirect($_SERVER['HTTP_REFERER']); 
        endif;
	 
	
	if($this->input->post('update_new_wrapper')):
	 
	    $name_is_unique = $ref_is_unique = '';
	    
	    if($this->input->post('wrapper_name') != $wrapper->wrapperName):
		$name_is_unique =  '|is_unique[wrappers.wrapperName]';
	    endif;
	    
	    if($this->input->post('Reference') != $wrapper->wrapperRef):
		$ref_is_unique =  '|is_unique[wrappers.wrapperRef]';
	    endif;
	
            $this->form_validation->set_rules('wrapper_name', 'Wrapper Name', 'trim|required'.$name_is_unique);
	    $this->form_validation->set_rules('wrapper_name', 'Wrapper Name', 'trim|required'.$ref_is_unique);
	  
             if($this->form_validation->run()):
	
		$content['wrapperName']= $this->input->post('wrapper_name');
		$content['wrapperRef']= $this->input->post('Reference');		
		
		//$content['wrapperIsActive'] = 1;
		
		$this->wrapper_accssor->updateRecord($content, array('wrapperBaseUrl'=>$wrapperBaseUrl));
		
		
		$this->session->set_flashdata('message', 'Record updated');
		$this->session->set_flashdata('type', 'flash_success');
	       redirect(base_url('wrapper/'.$wrapperBaseUrl)); 
               
	     endif;
	
	endif;
	
	$data['page_title'] = "New Wrapper";      
	$data['link_title'] = "setting";  
	 $data['mode'] = "edit";  
	 
	 $data['show_wrapper_rules_link'] = "true";
	$data['show_products_link'] = "true";
	
	

	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('wrappers/form-wrapper', $data);
	$this->load->view('templates/footer', $data);
    }
    
    
    function viewWrapper($wrapperBaseUrl){
	
	$data['wrapper'] = $wrapper = $this->wrapper_accssor->getRecordByURL($wrapperBaseUrl);
	
	if(empty($wrapper)):	
             $this->session->set_flashdata('message', 'Wrapper Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	 
	
	$data['show_wrapper_rules_link'] = "true";
	$data['show_products_link'] = "true";
	
	
	$data['page_title'] = "Wrapper - ".$wrapper->wrapperName;       
	$data['link_title'] = "setting";  
	
	
	$data['products'] = $products = $this->product_accessor->listproductsByWhere(array('wrappers_wrapperID'=>$wrapper->wrapperID));

	if(!empty($products)):
	    foreach ($products as $product_k => $product_val):
	    $data["product_options"][$product_val->productID]= $this->product_accessor->listproductOptionsByWhere(array('products_productID'=>$product_val->productID));
	    endforeach; 
	endif;
	
	
	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('wrappers/wrapper-view', $data);
	$this->load->view('templates/footer', $data);
	
    }
    
    
    
    
      
    
    /**#############LIST WRAPPER RULES #####*****************/
    function WrapperRules_list($wrapperBaseUrl){
	
	$data['wrapper'] = $wrapper = $this->wrapper_accssor->getRecordByURL($wrapperBaseUrl);
	
	if(empty($wrapper)):	
             $this->session->set_flashdata('message', 'Wrapper Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	 
	

	if($this->input->post('add_rule')):

	    $this->form_validation->set_rules('rule', 'Rule', 'trim|required');
	    $this->form_validation->set_rules('wrapperRuleDesc', 'Description', 'trim|required');
	  
             if($this->form_validation->run()):
	
		$content['wrapperRuleName']= $this->input->post('rule');
		$content['wrapperRuleDesc']= $this->input->post('wrapperRuleDesc');
		$content['wrappers_wrapperID']= $wrapper->wrapperID;
		
		$this->wrapper_accssor->AddWrapperRule($content);
		
		
		$this->session->set_flashdata('message', 'Record Created');
		$this->session->set_flashdata('type', 'flash_success');
	       redirect(base_url('wrapper/'.$wrapperBaseUrl."/list-rules")); 
               
	     endif;
	     
	    
	
	endif;
	
	
	 $data['mode'] = "new";
	$data['show_wrapper_rules_link'] = "true";
	$data['show_products_link'] = "true";
	
	
	
	$data['page_title'] = "Wrapper - ".$wrapper->wrapperName;       
	$data['link_title'] = "setting";  
	
	$data['wrapper_rules'] = $this->wrapper_accssor->listWrapperRulesByWhere(
		array('wrapper_rules.wrappers_wrapperID'=>$wrapper->wrapperID));

	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('wrappers/list-wrapper-rules', $data);
	$this->load->view('templates/footer', $data);
    }
    
    
    
    function WrapperRules_addNewBACKUP($wrapperBaseUrl){
	
	$data['wrapper'] = $wrapper = $this->wrapper_accssor->getRecordByURL($wrapperBaseUrl);
	
	if(empty($wrapper)):	
             $this->session->set_flashdata('message', 'Wrapper Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	 
	
	if($this->input->post('add_rule')):

	    $this->form_validation->set_rules('rule', 'Rule', 'trim|required');
	    $this->form_validation->set_rules('wrapperRuleDesc', 'Description', 'trim|required');
	  
             if($this->form_validation->run()):
	
		$content['wrapperRuleName']= $this->input->post('rule');
		$content['wrapperRuleDesc']= $this->input->post('wrapperRuleDesc');
		
		$this->wrapper_accssor->AddWrapperRule($content);
		
		
		$this->session->set_flashdata('message', 'Record Created');
		$this->session->set_flashdata('type', 'flash_success');
	       redirect(base_url('wrapper/'.$wrapperBaseUrl)); 
               
	     endif;
	
	endif;
	
	
	$data['wrapper_rules'] = "true";
	
	
	$data['page_title'] = "Wrapper - ".$wrapper->wrapperName;       
	$data['link_title'] = "setting";  
	$data['mode'] = "new"; 
	
	$data['wrapper_rules'] = $this->wrapper_accssor->listWrapperRulesByWhere(
		array('wrapper_rules.wrappers_wrapperID'=>$wrapper->wrapperID));

	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('wrappers/form-wrapper-rules', $data);
	$this->load->view('templates/footer', $data);
    }
    
    
    
    

    
    
}