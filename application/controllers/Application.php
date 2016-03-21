<?php



/**
 * Description of Application
 * manages clients applications
 *
 * @author itischarles
 */
class Application extends MY_Controller{
    
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
      
	//$this->load->model('Country_model');
	//$this->load->model('EmploymentType_model');
	//$this->load->model('MaritalStatus_model');
	
    $this->user_accessor = new User_Model();        
    $this->client_accessor = new Client_model(); 
    $this->title_accessor = new Title_model();
    $this->adviser_company_accessor = new Adviser_company_model();
    
    //$this->country_accessor = new Country_model(); 
   // $this->employmentType_accessor = new EmploymentType_model(); 
   //  $this->maritalStatus_accessor = new MaritalStatus_model(); 
     $this->wrapper_accssor = new Wrapper_model();
    // you need to be authenticated to view this controller
    $this->user_accessor->authenticate($this->session->userdata('userID'));
  
    
  
               
    }
    
    
    /**
     * 
     * @$clientUrl string url of the client who wishes to make the application
     * @$accountUrl string url of the account you wish to apply for
     * @abstract if the client and or account does not exit, redirect to error page
     *
     * if ISA application and the client had already applied for this account for the same tax year
     * display a message that the action is not possible
     */
    function newApplication($clientUrl, $wrapperUrl){
	
	$data['client'] = $clientDetails = $this->client_accessor->getClientByURL($clientUrl);
	$wrapper = $this->wrapper_accssor->getRecordByURL($wrapperUrl);
	
	if(empty($clientDetails) || empty($wrapper)):	
             $this->session->set_flashdata('message', 'Invalid selection detected');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	if($this->input->post('continue')):
	    $this->form_validation->set_rules('[rule_understood', 'Rules', 'trim|required|exact[1]');       
            $this->form_validation->set_rules('details_correct', 'Details', 'trim|required');            
         
	    if($this->form_validation->run()):
		 //title_titleID
		//$content['advisers_adviserID']= $this->input->post('adviserID');
		$content['clientTitle']= $this->input->post('rule_understood');
		$content['clientFname']= $this->input->post('details_correct');
	
	    endif;
	    
	endif;
	//print_r($_POST);
	$data['accountRules'] = $this->wrapper_accssor->listWrapperRulesByWhere(array('wrapper_rules.wrappers_wrapperID'=>$wrapper->wrapperID));
	
	$data['page_title'] = "New {$wrapper->wrapperName} Application: ".$clientDetails->clientFname." ".$clientDetails->clientLname;       
	$data['link_title'] = "client";  
	
	//$data['extra_js'] = base_url('js/client-js.js');

	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('application/index', $data);
	$this->load->view('templates/footer', $data);
	
    }
    
    
    
    function editAppplication(){
	
    }
}

?>