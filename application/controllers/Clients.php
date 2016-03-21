<?php


/**
 * Description of Client
 *
 * @author itischarles
 */
class Clients extends MY_Controller {
    var $user_accessor =''; // to access the user model
    var $client_accessor = '';
    var $title_accessor;
    var $adviser_company_accessor;
    var $country_accessor;
    var $employmentType_accessor;
    var $maritalStatus_accessor;
     var $wrapper_accssor = '';
  
    function __construct() {
        parent::__construct();
      
	$this->load->model('Country_model');
	$this->load->model('EmploymentType_model');
	$this->load->model('MaritalStatus_model');
    $this->user_accessor = new User_Model();        
    $this->client_accessor = new Client_model(); 
    $this->title_accessor = new Title_model();
    $this->adviser_company_accessor = new Adviser_company_model();
    
    $this->country_accessor = new Country_model(); 
    $this->employmentType_accessor = new EmploymentType_model(); 
     $this->maritalStatus_accessor = new MaritalStatus_model(); 
     $this->wrapper_accssor = new Wrapper_model();
    // you need to be authenticated to view this controller
    $this->user_accessor->authenticate($this->session->userdata('userID'));
  
    
  
               
    }
    
    
    
    function index(){
    $client_name  = ($this->input->get('client_name') ? $this->input->get('client_name') : '');
    $client_ref  = ($this->input->get('client_ref') ? $this->input->get('client_ref') : '');
    $postcode  = ($this->input->get('postcode') ? $this->input->get('postcode') : '');
    $client_ni  = ($this->input->get('client_ni') ? $this->input->get('client_ni') : '');
 
	$where_search = array();
	
    if(!empty($client_name)):
	// it is possible foirst name and last name is supplied
	 $names = explode(' ', $client_name);
    
	 $name_part1 = $name_part2= '';
    
	 $name_part1 = "(clients.clientFname like '{$names[0]}%' OR "
		    . "clients.clientLname like '{$names[0]}%' )";
	 if(isset($names[1])):
	      $name_part2 = "AND (clients.clientFname like '{$names[1]}%' OR "
		    . "clients.clientLname like '{$names[1]}%' )";
	 endif;
//	 $where_search[] = "(clients.clientFname like '$client_name%' OR "
//		    . "clients.clientLname like '$client_name%' )";
	  $where_search[] = "$name_part1 $name_part2";
    endif;
    
    if(!empty($client_ref)):
	 $where_search[] = "(clients.clientReference like '$client_ref%')";
    endif;
    if(!empty($postcode)):
	 $where_search[] = "(clients.clientReference like '$postcode%')";
    endif;
    if(!empty($client_ni)):
	 $where_search[] = "(clients.clientReference like '$client_ni%')";
    endif;
  

    $offset = ($this->input->get('offset')? $this->input->get('offset') : ''); 
    $per_page  = ($this->input->get('result_per_page')? $this->input->get('result_per_page') : 200);
	

	
	$config['base_url'] = base_url('financial-advisers');
	$config['total_rows'] = $data['db_total_rows'] = $this->client_accessor->searchClientDetails($where_search, false, false,true);	
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
	$data['clients'] = $this->client_accessor->searchClientDetails($where_search, $per_page,$offset);
	
	
	
	$data['page_title'] = "Clients";      
	$data['link_title'] = "workflow";  
	
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('clients/list-clients', $data);
        $this->load->view('templates/footer', $data);
    }
    
    
    
    
    function newClient(){
	
	
	
	// what if the adviser is defined for this client
//	if($this->input->post('adviserID')):
//	     $adviserUrl = $this->input->post('adviserID');
//	     $adviserDetails  = $this->adviser_company_accessor->getAdviserDetails_URL($adviserUrl);
//	
//	     $adviserID = (!empty($adviserDetails)? $adviserDetails->adviserID : 0);
//	     
//	     $this->client_accessor->updateClient(array('advisers_adviserID'=>$adviserID), 
//		     array('clientID'=>$clientDetails->clientID));
//	endif;
	
//	echo "<pre>";
//	print_r($_POST);
//	
//	return false;
	
	if($this->input->post('save_cdetails')):
	    
	    
//	    if($this->input->post('adviserCompanyName') != $adviserCompany->adviserCompanyName):
//		$is_unique =  '|is_unique[adviser_company.adviserCompanyName]';
//	    else:
//		 $is_unique =  '';
//	    endif;		
	
           // $this->form_validation->set_rules('adviserCompanyName', 'Company Name', 'trim|required'.$is_unique);
            
	    $this->form_validation->set_rules('retirementAge', 'Retirement Age', 'trim|required|max_length[3]|greater_than[0]');
	    $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[3]|greater_than[0]');
	    $this->form_validation->set_rules('FirstName', 'First Name', 'trim|required|alpha');
	    $this->form_validation->set_rules('LastName', 'Last Name', 'trim|required|alpha');
	    $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|valid_date_format');	    
	    $this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required|max_length[3]|greater_than[0]');
	    $this->form_validation->set_rules('gender', 'Gener', 'trim|required|alpha|max_length[1]');
	    	    
	    $this->form_validation->set_rules('AddressLine1', 'Address Line 1', 'trim|required');       
            $this->form_validation->set_rules('City', 'City', 'trim|required');            
            $this->form_validation->set_rules('County', 'County', 'trim|required');
            $this->form_validation->set_rules('Postcode', 'Postcode', 'trim|required'); 
	    $this->form_validation->set_rules('country', 'Country', 'trim|required|alpha|exact_length[2]'); 
            $this->form_validation->set_rules('Email', 'Eamil', 'trim|required|valid_email');
	    $this->form_validation->set_rules('ni', 'National Insurance', 'trim|required|valid_NI|is_unique[clients.clientNI]');
	    
	  
             if($this->form_validation->run()):
		 //title_titleID
		//$content['advisers_adviserID']= $this->input->post('adviserID');
		$content['clientTitle']= $this->input->post('title');
		$content['clientFname']= $this->input->post('FirstName');
		$content['clientMidName']= $this->input->post('midName');
		$content['clientLname']= $this->input->post('LastName');
		$content['clientDOB']= changeDateFormat($this->input->post('dob'), 'Y-m-d');
		$content['maritalStatusID']= $this->input->post('marital_status');
		$content['clientGender']= $this->input->post('gender');
		$content['clientAddressLine1']= $this->input->post('AddressLine1');
		$content['clientAddressLine2']= $this->input->post('AddressLine2');
		$content['clientAddressLine3']= $this->input->post('AddressLine3');
		$content['clientCity']= $this->input->post('City');
		$content['clientCounty']= $this->input->post('County');
		$content['clientPostcode']= $this->input->post('Postcode');
		$content['countryAlpha2']= $this->input->post('country');
		$content['clientEmail']= $this->input->post('Email');
		 
		$content['clientRetirementAge']= $this->input->post('retirementAge');
		$content['clientTelephone']= $this->input->post('Telephone');
		$content['clientMobile']= $this->input->post('Mobile');
		$content['clientNI']= $this->input->post('ni');
		$content['employmentTypeCode']= $this->input->post('employmentType');
		
		
		$content['status_statusID'] = 3; // draft
		$content['clientDateCreated'] = changeDateFormat('now', 'Y-m-d', true);
		$content['createdByUserID'] = $this->_getCurrentUserID();
		$content['clientBaseUrl'] = $clientBaseUrl =  $this->client_accessor->generateUrl();
		
		$this->client_accessor->addNew($content);
		
		
		$this->session->set_flashdata('message', 'Record Created');
		$this->session->set_flashdata('type', 'flash_success');
	       redirect(base_url('client/'.$clientBaseUrl)); 
               
	     endif;
	
	endif;
	 
	 
	 
	//$data['client'] = $this->client_accessor->getClientDetailsByID($clientDetails->clientID);
	
	$data['titles'] = $this->title_accessor->listTitleActiveTitles();
	$data['countries'] = $this->country_accessor->listCountriesByWhere();
	$data['employmentTypes'] = $this->employmentType_accessor->listEmploymentTypesByWhere();
	$data['marital_status'] = $this->maritalStatus_accessor->listMaritalStatusByWhere();
	
	$data['page_title'] = "Individual New Member";      
	$data['link_title'] = "workflow";  
	
	$data['extra_js'] = base_url('js/client-js.js');

	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('clients/client-form', $data);
	$this->load->view('templates/footer', $data);
	
	/**
	 * 
	    $data['page_title'] = "Individual New Member - member Details";      
	    $data['link_title'] = "workflow";  
	    $data['mode'] = "new";  

	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/navbar', $data);
	    $this->load->view('clients/client-form', $data);
	    $this->load->view('templates/footer', $data);
	 * 
	 */
	
	
//	$content['status_statusID'] = 1; // temp
//	$content['clientDateCreated'] = changeDateFormat('now', 'Y-m-d', true);
//	$content['createdByUserID'] = $this->_getCurrentUserID();
//	$content['clientBaseUrl'] = $clientBaseUrl =  $this->client_accessor->generateUrl();
//	
//	$this->client_accessor->addNew($content);
//	
//	redirect(base_url('client/'.$clientBaseUrl."/applicant-details"));
	
    }
    
    
    /**new client/memeber page 1**/
    function editClient($clientBaseUrl = ''){
	
	$clientDetails = $this->client_accessor->getClientByURL($clientBaseUrl);
	
	if(empty($clientDetails)):	
             $this->session->set_flashdata('message', 'Client Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	// what if the adviser is defined for this client
//	if($this->input->post('adviserID')):
//	     $adviserUrl = $this->input->post('adviserID');
//	     $adviserDetails  = $this->adviser_company_accessor->getAdviserDetails_URL($adviserUrl);
//	
//	     $adviserID = (!empty($adviserDetails)? $adviserDetails->adviserID : 0);
//	     
//	     $this->client_accessor->updateClient(array('advisers_adviserID'=>$adviserID), 
//		     array('clientID'=>$clientDetails->clientID));
//	endif;
	
//	echo "<pre>";
//	print_r($_POST);
//	
//	return false;
	
	if($this->input->post('save_cdetails')):
	    
	    
//	    if($this->input->post('adviserCompanyName') != $adviserCompany->adviserCompanyName):
//		$is_unique =  '|is_unique[adviser_company.adviserCompanyName]';
//	    else:
//		 $is_unique =  '';
//	    endif;		
	
           // $this->form_validation->set_rules('adviserCompanyName', 'Company Name', 'trim|required'.$is_unique);
            
	    $this->form_validation->set_rules('retirementAge', 'Retirement Age', 'trim|required|max_length[3]|greater_than[0]');
	    $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[3]|greater_than[0]');
	    $this->form_validation->set_rules('FirstName', 'First Name', 'trim|required|alpha');
	    $this->form_validation->set_rules('LastName', 'Last Name', 'trim|required|alpha');
	    $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|valid_date_format');	    
	    $this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required|max_length[3]|greater_than[0]');
	    $this->form_validation->set_rules('gender', 'Gener', 'trim|required|alpha|max_length[1]');
	    
	    $this->form_validation->set_rules('AddressLine1', 'Address Line 1', 'trim|required');       
            $this->form_validation->set_rules('City', 'City', 'trim|required');            
            $this->form_validation->set_rules('County', 'County', 'trim|required');
            $this->form_validation->set_rules('Postcode', 'Postcode', 'trim|required'); 
	    $this->form_validation->set_rules('country', 'Country', 'trim|required|alpha|exact_length[2]'); 
            $this->form_validation->set_rules('Email', 'Eamil', 'trim|required|valid_email');
	    $this->form_validation->set_rules('ni', 'National Insurance', 'trim|required|valid_NI');
	    
	  
             if($this->form_validation->run()):
		 //title_titleID
		//$content['advisers_adviserID']= $this->input->post('adviserID');
		$content['clientTitle']= $this->input->post('title');
		$content['clientFname']= $this->input->post('FirstName');
		$content['clientMidName']= $this->input->post('midName');
		$content['clientLname']= $this->input->post('LastName');
		$content['clientDOB']= changeDateFormat($this->input->post('dob'), 'Y-m-d');
		$content['maritalStatusID']= $this->input->post('marital_status');
		$content['clientGender']= $this->input->post('gender');
		$content['clientAddressLine1']= $this->input->post('AddressLine1');
		$content['clientAddressLine2']= $this->input->post('AddressLine2');
		$content['clientAddressLine3']= $this->input->post('AddressLine3');
		$content['clientCity']= $this->input->post('City');
		$content['clientCounty']= $this->input->post('County');
		$content['clientPostcode']= $this->input->post('Postcode');
		$content['countryAlpha2']= $this->input->post('country');
		$content['clientEmail']= $this->input->post('Email');
		 
		$content['clientRetirementAge']= $this->input->post('retirementAge');
		$content['clientTelephone']= $this->input->post('Telephone');
		$content['clientMobile']= $this->input->post('Mobile');
		$content['clientNI']= $this->input->post('ni');
		$content['employmentTypeCode']= $this->input->post('employmentType');
		
		// if status is temp, now change it to draft
		if($clientDetails->status_statusID == 1):
		    $content['status_statusID']= 3;
		endif;
		
		$this->client_accessor->updateClient($content, array('clientBaseUrl'=>$clientBaseUrl));
		 
		$this->session->set_flashdata('message', 'Record Updated');
		$this->session->set_flashdata('type', 'flash_success');
	       redirect(base_url('client/'.$clientBaseUrl)); 
               
	     endif;
	
	endif;
	 
	 
	 
	$data['client'] = $this->client_accessor->getClientDetailsByID($clientDetails->clientID);
	
	$data['titles'] = $this->title_accessor->listTitleActiveTitles();
	$data['countries'] = $this->country_accessor->listCountriesByWhere();
	$data['employmentTypes'] = $this->employmentType_accessor->listEmploymentTypesByWhere();
	$data['marital_status'] = $this->maritalStatus_accessor->listMaritalStatusByWhere();
	
	$data['page_title'] = "Individual New Member - Member Details";      
	$data['link_title'] = "workflow";  
	
	$data['extra_js'] = base_url('js/client-js.js');

	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('clients/client-form', $data);
	$this->load->view('templates/footer', $data);
	
	
    }
    
    
    
    function viewClient($clientBaseUrl){
	
	$clientDetails = $this->client_accessor->getClientByURL($clientBaseUrl);
	
	if(empty($clientDetails)):	
             $this->session->set_flashdata('message', 'Client Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	 
	$data['client'] = $this->client_accessor->getClientDetailsByID($clientDetails->clientID);
	
	$data['titles'] = $this->title_accessor->listTitleActiveTitles();
	$data['countries'] = $this->country_accessor->listCountriesByWhere();
	$data['employmentTypes'] = $this->employmentType_accessor->listEmploymentTypesByWhere();
	$data['marital_status'] = $this->maritalStatus_accessor->getMaritalStatusByID($clientDetails->maritalStatusID);
	
	$data['wrappers'] = $this->wrapper_accssor->listWrappersByWhere(array('wrapperIsActive'=>1));
	
	
	$data['page_title'] = "Individual Member - ".$clientDetails->clientFname." ".$clientDetails->clientLname;       
	$data['link_title'] = "client";  
	
	$data['extra_js'] = base_url('js/client-js.js');

	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('clients/client-view', $data);
	$this->load->view('templates/footer', $data);
	
    }
}
