<?php



/**
 * Description of Error
 * custom error handling
 * @author itischarles
 */
class Error_custom extends MY_Controller{
    //put your code here
    
    
    function __construct() {
	parent::__construct();
    }
    
    
    
    function index(){
	
	$data['page_title'] = "404 Page Not Found";
	$data['heading'] = "404 Page not Found";
	$data['message'] = "Sorry we are unable to find the page you are after";
	
	$this->output->set_status_header('404'); // setting header to 404
      
	
	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('Error_custom/error-404', $data);
	$this->load->view('templates/footer', $data);
    }
    
    
    
}
