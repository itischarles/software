<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Financial_adviser
 *
 * @author itischarles
 */
class Financial_adviser extends MY_Controller {
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
    
    

    
    function searchFinancialAdvisersCompany(){
	$company_ref  = ($this->input->get('company_ref') ? $this->input->get('company_ref') : '');
	$company_name  = ($this->input->get('company_name') ? $this->input->get('company_name') : '');
   
	$where_search = array();
	
//    if(!empty($company_ref)):
//	 $where_search[] = "(adviser_company.userFirstName like '$adviser_name' OR "
//		    . "users.userLastName like '$adviser_name' )";
//    endif;
     
    if(!empty($company_name)):
	 $where_search[] = "(adviser_company.adviserCompanyName like '$company_name%')";
    endif;
    

    $offset = ($this->input->get('offset')? $this->input->get('offset') : ''); 
    $per_page  = ($this->input->get('result_per_page')? $this->input->get('result_per_page') : 200);
	

	
	$config['base_url'] = base_url('fa-companies');
	$config['total_rows'] = $data['db_total_rows'] = $this->adviser_company_accessor->searchFinancialAdviserCompanies($where_search, false, false,true);	
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
	$data['fa_companies'] = $this->adviser_company_accessor->searchFinancialAdviserCompanies($where_search, $per_page,$offset);

	
	$data['page_title'] = "Financial Adviser Company";      
	$data['link_title'] = "fa";  
	
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/list-companies', $data);
        $this->load->view('templates/footer', $data);
    }
    
    
    
    function addFinancialAdviserCompany(){
	
	if($this->input->post('add_adviser_company')):
	    $this->form_validation->set_rules('adviserCompanyRef', 'Company Ref', 'trim|required|is_unique[adviser_company.adviserCompanyRef]');
            $this->form_validation->set_rules('adviserCompanyName', 'Company Name', 'trim|required|is_unique[adviser_company.adviserCompanyName]');
            $this->form_validation->set_rules('adviserCompanyAddress1', 'Address Line 1', 'trim|required');
       
            $this->form_validation->set_rules('adviserCompanyCity', 'City', 'trim|required');            
            $this->form_validation->set_rules('adviserCompanyCounty', 'County', 'trim|required');
            $this->form_validation->set_rules('adviserCompanyPostcode', 'Postcode', 'trim|required');            
            $this->form_validation->set_rules('adviserCompanyEmail', 'Eamil', 'trim|required|valid_email');
          
             if($this->form_validation->run()):
		    $content['adviserCompanyRef'] = $this->input->post('adviserCompanyRef');
                    $content['adviserCompanyName'] = $this->input->post('adviserCompanyName');
                    $content['adviserCompanyAddress1'] = $this->input->post('adviserCompanyAddress1');
		    $content['adviserCompanyAddress2'] = $this->input->post('adviserCompanyAddress2');
		    $content['adviserCompanyAddress3'] = $this->input->post('adviserCompanyAddress3');
                    $content['adviserCompanyCity'] = $this->input->post('adviserCompanyCity');
		    $content['adviserCompanyCounty'] = $this->input->post('adviserCompanyCounty');
                    $content['adviserCompanyPostcode'] = $this->input->post('adviserCompanyPostcode');
                    $content['adviserCompanyEmail'] = $this->input->post('adviserCompanyEmail');
		     $content['adviserCompanyNetworkID'] = $this->input->post('adviserCompanyNetworkID');            
                   $content['adviserCompanyTel'] = $this->input->post('adviserCompanyTel');
		    
		    
                    $content['adviserCompanyBaseUrl'] = $adviserCompanyBaseUrl = $this->adviser_company_accessor->generateUrl();
                    
                   $this->adviser_company_accessor->addNewCompany($content);
                                         
		    $this->session->set_flashdata('message', 'New record added successfully');
		    $this->session->set_flashdata('type', 'flash_success');
		   redirect(base_url('financial-adviser/company/'.$adviserCompanyBaseUrl)); 
               
            endif;
              
        endif;
	
	$data['adviserCompanyNetwork'] = $this->adviser_company_accessor->listCompanyNetworks();
	
	$data['page_title'] = "New Financial Adviser Company";      
	$data['link_title'] = "fa";	
	$data['mode'] = "new"; 
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/form-company', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    function editFinancialAdviserCompany($baseUrl){
	
	$data['adviserCompany'] = $adviserCompany = $this->adviser_company_accessor->getFACompanyByURL($baseUrl);
	
	if(empty($adviserCompany)):	
             $this->session->set_flashdata('message', 'FA Company Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	if($this->input->post('update_adviser_company')):
	    
	    
	    if($this->input->post('adviserCompanyName') != $adviserCompany->adviserCompanyName):
		$is_unique =  '|is_unique[adviser_company.adviserCompanyName]';
	    else:
		 $is_unique =  '';
	    endif;

	    if($this->input->post('adviserCompanyRef') != $adviserCompany->adviserCompanyRef):
		$is_unique_compRef =  '|is_unique[adviser_company.adviserCompanyRef]';
	    else:
		 $is_unique_compRef =  '';
	    endif;
	
	    $this->form_validation->set_rules('adviserCompanyRef', 'Company Ref', 'trim|required'.$is_unique_compRef);
            $this->form_validation->set_rules('adviserCompanyName', 'Company Name', 'trim|required'.$is_unique);
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
		    $content['adviserCompanyNetworkID'] = $this->input->post('adviserCompanyNetworkID');                        
                   $content['adviserCompanyTel'] = $this->input->post('adviserCompanyTel');
                   $content['adviserCompanyRef'] = $this->input->post('adviserCompanyRef');
		   
                   $this->adviser_company_accessor->updateAdviserCompany($content, 
			    array('adviserCompanyID'=>$adviserCompany->adviserCompanyID));
                                         
		    $this->session->set_flashdata('message', 'New record added successfully');
		    $this->session->set_flashdata('type', 'flash_success');
		   redirect(base_url('financial-adviser/company/'.$baseUrl)); 
               
            endif;
              
        endif;
	
	
	$data['adviserCompanyNetwork'] = $this->adviser_company_accessor->listCompanyNetworks();
	
	
	$data['page_title'] = "Financial Adviser Company";      
	$data['link_title'] = "fa";	
	$data['mode'] = "edit"; 
	//$date['form_title'] =
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/form-company', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
    function viewFinancialAdviserCompany($baseUrl){
	
	$data['adviserCompany'] = $adviserCompany = $this->adviser_company_accessor->getFACompanyByURL($baseUrl);
	
	if(empty($adviserCompany)):	
             $this->session->set_flashdata('message', 'FA Company Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;

	
	$data['page_title'] = "Financial Adviser Company";      
	$data['link_title'] = "l";  
	//$data['sidebar'] = "elements/elements-sidebar-add";
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/view-company', $data);
        $this->load->view('templates/footer', $data);
	
    }
    
    
    
    /**
     * add financial adviser company network
     */
    
    
    function searchFinancialAdvisersCompanyNetwrok(){
	$network_ref  = ($this->input->get('network_ref') ? $this->input->get('network_ref') : '');
	$network_name  = ($this->input->get('network_name') ? $this->input->get('network_name') : '');
   
	$where_search = array();
	
    if(!empty($network_ref)):
	 $where_search[] = "(adviserCompanyNetwork.adviserCompanyNetworkReference like '$network_ref')";
    endif;
     
    if(!empty($network_name)):
	 $where_search[] = "(adviserCompanyNetwork.adviserCompanyNetworkName like '$network_name%')";
    endif;
    

    $offset = ($this->input->get('offset')? $this->input->get('offset') : ''); 
    $per_page  = ($this->input->get('result_per_page')? $this->input->get('result_per_page') : 200);
	

	
	$config['base_url'] = base_url('financial-adviser/networks');
	$config['total_rows'] = $data['db_total_rows'] = $this->adviser_company_accessor->searchCompanyNetworks($where_search, false, false,true);	
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
	$data['adviserCompanyNetworks'] = $this->adviser_company_accessor->searchCompanyNetworks($where_search, $per_page,$offset);

	
	$data['page_title'] = "Adviser Company Network";      
	$data['link_title'] = "fa";  
	
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/list-company-networks', $data);
        $this->load->view('templates/footer', $data);
    }
    
    
    
    function addFinancialAdviserCompanyNetwrok(){
	
	if($this->input->post('add_companyNetwork')):
	     $this->form_validation->set_rules('adviserCompanyNetworkReference', 'Company Netwrok Ref.', 'trim|required|is_unique[adviserCompanyNetwork.adviserCompanyNetworkReference]');
            $this->form_validation->set_rules('adviserCompanyNetworkName', 'Company Netwrok Name', 'trim|required|is_unique[adviserCompanyNetwork.adviserCompanyNetworkName]');
            $this->form_validation->set_rules('adviserCompanyNetworkAddress1', 'Address Line 1', 'trim|required');
       
            $this->form_validation->set_rules('adviserCompanyNetworkCity', 'City', 'trim|required');            
            $this->form_validation->set_rules('adviserCompanyNetworkCounty', 'County', 'trim|required');
            $this->form_validation->set_rules('adviserCompanyNetworkPostcode', 'Postcode', 'trim|required');            
            $this->form_validation->set_rules('adviserCompanyNetworkEmail', 'Eamil', 'trim|required|valid_email');
          
             if($this->form_validation->run()):
		     $content['adviserCompanyNetworkReference']  = $this->input->post('adviserCompanyNetworkReference');
                    $content['adviserCompanyNetworkName'] = $this->input->post('adviserCompanyNetworkName');
                    $content['adviserCompanyNetworkAddress1'] = $this->input->post('adviserCompanyNetworkAddress1');
		    $content['adviserCompanyNetworkAddress2'] = $this->input->post('adviserCompanyNetworkAddress2');
		    $content['adviserCompanyNetworkAddress3'] = $this->input->post('adviserCompanyNetworkAddress3');
                    $content['adviserCompanyNetworkCity'] = $this->input->post('adviserCompanyNetworkCity');
		    $content['adviserCompanyNetworkCounty'] = $this->input->post('adviserCompanyNetworkCounty');
                    $content['adviserCompanyNetworkPostcode'] = $this->input->post('adviserCompanyNetworkPostcode');
                    $content['adviserCompanyNetworkEmail'] = $this->input->post('adviserCompanyNetworkEmail');
		    $content['adviserCompanyNetworkTel'] = $this->input->post('adviserCompanyNetworkTel');
		                
                   
                    $content['adviserCompanyNetworkBaseUrl'] = $adviserCompanyNetworkBaseUrl = $this->adviser_company_accessor->generateUrl();
                    
                   $this->adviser_company_accessor->addNewCompanyNetwork($content);
                                         
		    $this->session->set_flashdata('message', 'New record added successfully');
		    $this->session->set_flashdata('type', 'flash_success');
		   redirect(base_url('/financial-adviser/network/'.$adviserCompanyNetworkBaseUrl)); 
               
            endif;
              
        endif;
	
	
	
	$data['page_title'] = "New Financial Adviser Company Network";      
	$data['link_title'] = "fa";	
	$data['mode'] = "new"; 
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/form-company-network', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
    function viewFinancialAdviserCompanyNetwrok($baseUrl){
	$data['adviserCompanyNetwork'] = $adviserCompanyNetwork = $this->adviser_company_accessor->getCompanyNetworkByURL($baseUrl);
	
	if(empty($adviserCompanyNetwork)):	
             $this->session->set_flashdata('message', 'FA Company Network Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;

	
	$data['page_title'] = "Financial Adviser Company Network";      
	$data['link_title'] = "fa";  
	//$data['sidebar'] = "elements/elements-sidebar-add";
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/view-company-network', $data);
        $this->load->view('templates/footer', $data);
    }
    
    
    function editFinancialAdviserCompanyNetwrok($baseUrl){
	
	$data['adviserCompanyNetwork'] = $adviserCompanyNetwork = $this->adviser_company_accessor->getCompanyNetworkByURL($baseUrl);
	
	if(empty($adviserCompanyNetwork)):	
             $this->session->set_flashdata('message', 'FA Company Network Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	
	if($this->input->post('update_companyNetwork')):
	    
	    if($this->input->post('adviserCompanyNetworkName') != $adviserCompanyNetwork->adviserCompanyNetworkName):
		$is_unique =  '|is_unique[adviserCompanyNetwork.adviserCompanyNetworkName]';
	    else:
		 $is_unique =  '';
	    endif;

	    if($this->input->post('adviserCompanyNetworkReference') != $adviserCompanyNetwork->adviserCompanyNetworkReference):
		$is_unique_ntwk =  '|is_unique[adviserCompanyNetwork.adviserCompanyNetworkReference]';
	    else:
		 $is_unique_ntwk =  '';
	    endif;
	
	    $this->form_validation->set_rules('adviserCompanyNetworkReference', 'Company Netwrok Ref.', 'trim|required'.$is_unique_ntwk);
            $this->form_validation->set_rules('adviserCompanyNetworkName', 'Company Netwrok Name', 'trim|required'.$is_unique);
          	    
            //$this->form_validation->set_rules('adviserCompanyNetworkName', 'Company Netwrok Name', 'trim|required|is_unique[adviserCompanyNetwork.adviserCompanyNetworkName]');
            $this->form_validation->set_rules('adviserCompanyNetworkAddress1', 'Address Line 1', 'trim|required');
       
            $this->form_validation->set_rules('adviserCompanyNetworkCity', 'City', 'trim|required');            
            $this->form_validation->set_rules('adviserCompanyNetworkCounty', 'County', 'trim|required');
            $this->form_validation->set_rules('adviserCompanyNetworkPostcode', 'Postcode', 'trim|required');            
            $this->form_validation->set_rules('adviserCompanyNetworkEmail', 'Eamil', 'trim|required|valid_email');
          
             if($this->form_validation->run()):
		    $content['adviserCompanyNetworkReference']  = $this->input->post('adviserCompanyNetworkReference');
                    $content['adviserCompanyNetworkName'] = $this->input->post('adviserCompanyNetworkName');
                    $content['adviserCompanyNetworkAddress1'] = $this->input->post('adviserCompanyNetworkAddress1');
		    $content['adviserCompanyNetworkAddress2'] = $this->input->post('adviserCompanyNetworkAddress2');
		    $content['adviserCompanyNetworkAddress3'] = $this->input->post('adviserCompanyNetworkAddress3');
                    $content['adviserCompanyNetworkCity'] = $this->input->post('adviserCompanyNetworkCity');
		    $content['adviserCompanyNetworkCounty'] = $this->input->post('adviserCompanyNetworkCounty');
                    $content['adviserCompanyNetworkPostcode'] = $this->input->post('adviserCompanyNetworkPostcode');
                    $content['adviserCompanyNetworkEmail'] = $this->input->post('adviserCompanyNetworkEmail');
		    $content['adviserCompanyNetworkTel'] = $this->input->post('adviserCompanyNetworkTel');
		                
                   
                  
                     $this->adviser_company_accessor->updateCompanyNetwork($content, 
			    array('adviserCompanyNetworkID'=>$adviserCompanyNetwork->adviserCompanyNetworkID));
                                         
		    $this->session->set_flashdata('message', 'Company Network updated successfully');
		    $this->session->set_flashdata('type', 'flash_success');
		   redirect(base_url('/financial-adviser/network/'.$baseUrl)); 
               
            endif;
              
        endif;
	
	
	
	$data['page_title'] = "New Financial Adviser Company Network";      
	$data['link_title'] = "fa";	
	$data['mode'] = "edit"; 
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/form-company-network', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
    
    
    
    
    /********FINANCIAL ADVISERS AREA********/
        
    function searchFinancialAdvisers(){
    $adviser_ref  = ($this->input->get('adviser_ref') ? $this->input->get('adviser_ref') : '');
     $adviser_name  = ($this->input->get('adviser_name') ? $this->input->get('adviser_name') : '');
   
	$where_search = array();
	
    if(!empty($adviser_name)):
	 $where_search[] = "(users.userFirstName like '$adviser_name%' OR "
		    . "users.userLastName like '$adviser_name%' )";
    endif;
     
//    if(!empty($adviser_ref)):
//	 $where_search[] = "(users.userFirstName like '$adviser_name' OR "
//		    . "users.userLastName like '$adviser_name')";
//    endif;
    

    $offset = ($this->input->get('offset')? $this->input->get('offset') : ''); 
    $per_page  = ($this->input->get('result_per_page')? $this->input->get('result_per_page') : 200);
	

	
	$config['base_url'] = base_url('financial-advisers');
	$config['total_rows'] = $data['db_total_rows'] = $this->adviser_company_accessor->searchFinancialAdviser($where_search, false, false,true);	
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
	$data['advisers'] = $this->adviser_company_accessor->searchFinancialAdviser($where_search, $per_page,$offset);

	
	
	$data['page_title'] = "Financial Advisers";      
	$data['link_title'] = "fa";  
	
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/list-fa', $data);
        $this->load->view('templates/footer', $data);
    }
    
    
    
    function addFinancialAdviser(){
	
	if($this->input->post('add_fa')):
	  
	    
            $this->form_validation->set_rules('userFirstName', 'Name', 'trim|required');
            $this->form_validation->set_rules('userLastName', 'Last Name', 'trim|required');
	    $this->form_validation->set_rules('userAddressLine1', 'Address Line 1', 'trim|required');
            $this->form_validation->set_rules('userCity', 'City', 'trim|required');            
            $this->form_validation->set_rules('userCounty', 'County', 'trim|required');
            $this->form_validation->set_rules('userPostcode', 'Postcode', 'trim|required');            
            $this->form_validation->set_rules('userEmail', 'Eamil', 'trim|required|valid_email');
	    $this->form_validation->set_rules('adviserReference', 'Adviser Ref.', 'trim|required|is_unique[advisers.adviserReference]');
	    if($this->input->post('userUsername')):
		$this->form_validation->set_rules('userUsername', 'UserName', 'trim|required|is_unique[users.userUsername]');
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
		    $content['userDateCreated'] = changeDateFormat('now', 'Y-m-d');
                    $content['userIsActive'] = 1;
		    $content['userBaseUrl'] = $userBaseUrl = $this->user_accessor->generateUrl();
		        
		    if($this->input->post('userUsername')):
			$content['userUsername'] = $this->input->post('userUsername');
			$content['userPassword'] = $this->user_accessor->_prep_password($this->input->post('userPassword'));
		    endif;
		    
		    $userID = $this->user_accessor->addNewUser($content);
		    
		    
		    $adviser['adviserFCAnumber'] = $this->input->post('adviserFCAnumber');
                    $adviser['adviserBankName'] = $this->input->post('adviserBankName');
		    $adviser['adviserBankAccount'] = $this->input->post('adviserBankAccount');
                    $adviser['adviserSortcode'] = $this->input->post('adviserSortcode');
		     $adviser['users_userID'] = $userID;          
                    $adviser['adviser_companyID'] = $this->input->post('adviser_companyID');
                     $adviser['adviserReference'] = $this->input->post('adviserReference');
		    $this->adviser_company_accessor->addNewAdviser($adviser);
                    
                   
		   
		   
                                         
		    $this->session->set_flashdata('message', 'New record added successfully');
		    $this->session->set_flashdata('type', 'flash_success');
		   redirect(base_url('financial-adviser/adviser/'.$userBaseUrl)); 
               
            endif;
              
        endif;
	
	
	
	$data['page_title'] = "New Financial Adviser";      
	$data['link_title'] = "fa";	
	$data['mode'] = "new"; 
	
	$data['adviserCompany'] = $this->adviser_company_accessor->listFACompanies();
	
	
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/form-fa', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
    function viewFinancialAdviser($baseurl){
	
	$data['adviser'] = $adviser = $this->adviser_company_accessor->getAdviserDetails_URL($baseurl);
	
	if(empty($adviser)):	
             $this->session->set_flashdata('message', 'FA Company Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	$data['page_title'] = "New Financial Adviser";      
	$data['link_title'] = "fa";	
	$data['mode'] = "new"; 
	
	
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('financial-adviser/view-fa', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
    function editFinancialAdviser($baseurl){
	
	$data['adviser'] = $adviser = $this->adviser_company_accessor->getAdviserDetails_URL($baseurl);
	
	if(empty($adviser)):	
             $this->session->set_flashdata('message', 'FA Company Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	
	if($this->input->post('update_fa')):
	  
	    if($this->input->post('userUsername') != $adviser->userUsername):
		$is_unique =  '|is_unique[users.userUsername]';
	    else:
		 $is_unique =  '';
	    endif;
	    
	    if($this->input->post('adviserReference') != $adviser->adviserReference):
		$is_unique_adv =  '|is_unique[advisers.adviserReference]';
	    else:
		 $is_unique_adv =  '';
	    endif;
	    
	    $this->form_validation->set_rules('userUsername', 'UserName', 'trim|required'.$is_unique);
	    $this->form_validation->set_rules('adviserReference', 'Adviser Ref.', 'trim|required'.$is_unique_adv);
            $this->form_validation->set_rules('userFirstName', 'Name', 'trim|required');
            $this->form_validation->set_rules('userLastName', 'Last Name', 'trim|required');
	    $this->form_validation->set_rules('userAddressLine1', 'Address Line 1', 'trim|required');
            $this->form_validation->set_rules('userCity', 'City', 'trim|required');            
            $this->form_validation->set_rules('userCounty', 'County', 'trim|required');
            $this->form_validation->set_rules('userPostcode', 'Postcode', 'trim|required');            
            $this->form_validation->set_rules('userEmail', 'Eamil', 'trim|required|valid_email');
        
	    
	    
	    
	    
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
		   // $content['userBaseUrl'] = $userBaseUrl = $this->user_accessor->generateUrl();
		        
		    if($this->input->post('userUsername')):
			$content['userUsername'] = $this->input->post('userUsername');			
		    endif;
		    
		    if($this->input->post('userPassword')):			
			$content['userPassword'] = $this->user_accessor->_prep_password($this->input->post('userPassword'));
		    endif;
		    
		    $userID = $this->user_accessor->updateUser($content, array('userID'=>$adviser->userID));
		    
		    
		    $content2['adviserFCAnumber'] = $this->input->post('adviserFCAnumber');
                    $content2['adviserBankName'] = $this->input->post('adviserBankName');
		    $content2['adviserBankAccount'] = $this->input->post('adviserBankAccount');
                    $content2['adviserSortcode'] = $this->input->post('adviserSortcode');
		   $content2['adviserReference'] = $this->input->post('adviserReference');         
                    $content2['adviser_companyID'] = $this->input->post('adviser_companyID');
                    
		    $this->adviser_company_accessor->updateAdviser($content2, array('adviserID'=>$adviser->adviserID, 'users_userID'=>$adviser->users_userID));
                    
                   
		   
		   
                                         
		    $this->session->set_flashdata('message', 'New record added successfully');
		    $this->session->set_flashdata('type', 'flash_success');
		   redirect(base_url('financial-adviser/adviser/'.$adviser->userBaseUrl)); 
               
            endif;
              
        endif;
	
	
	
	$data['page_title'] = "Edit Financial Adviser";      
	$data['link_title'] = "fa";	
	$data['mode'] = "edit"; 
	
	$data['adviserCompany'] = $this->adviser_company_accessor->listFACompanies();
	
	
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
//        $this->load->view('financial-adviser/fa-form', $data);
	 $this->load->view('financial-adviser/form-fa', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
    
    /**
     * using ajax request to load adviser.
     * request must come from a http post form
     */
    function xhttpListAdvisers(){
	if (!$this->input->is_ajax_request() ):
	    redirect('logout'); // logout if reqest is supecious
	    return false;
	endif;
	
	  $data = array();
	  
	if($this->input->post('adviser_name')):
	    $this->form_validation->set_rules('adviser_name', 'Adviser Name', 'trim|required');

	   if($this->form_validation->run()):                 

	       $adviser_name = $this->input->post('adviser_name');	
	       $where_search = array();

	       if(!empty($adviser_name)):
		    $where_search[] = "(users.userFirstName like '$adviser_name%' OR "
			       . "users.userLastName like '$adviser_name%' )";
	       endif;

	       $advisers = $this->adviser_company_accessor->searchFinancialAdviser($where_search, 200,'');
	       
	       if(!empty($advisers)):
		   $data['error'] = 0;
		   foreach ($advisers as $key=>$adn):
			$adv[] = array(
			    'code' => $adn->userBaseUrl,
			    'name' => $adn->userFirstName." ".$adn->userLastName,
			    'company'=> $adn->adviserCompanyName            
			);
		   endforeach;
		   
		   $data['adv'] = $adv;
	       endif;
	  
		$this->output->set_content_type('application/json');
		$this->output->set_output( json_encode($data) );

		

	   endif;
	endif;
	
	return false;
    }
    
    
    
    
}



