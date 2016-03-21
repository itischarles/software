<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Settings
 *
 * @author itischarles
 */
class System_settings extends MY_Controller {
     var $user_accessor =''; // to access the user model
    var $client_accessor = '';
    var $title_accessor;
    var $adviser_company_accessor;
    var $country_accessor;
    var $employmentType_accessor;
    var $maritalStatus_accessor;
  
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
    // you need to be authenticated to view this controller
    $this->user_accessor->authenticate($this->session->userdata('userID'));
  
    
  
               
    }
    
    
  
    // search clients
//    function index(){
//	return false;
//        $data = array();
//        
//          $data['page_title'] = "Site Settings";      
//          $data['link_title'] = "setting";          
//          //$data['sublink_title'] = "invoice";
//         
//          // define the links that  would be displayed in the page header area
//          
//       
//         
//         
//        
//        $this->load->view('templates/header', $data);
//         $this->load->view('templates/navbar', $data);
//        $this->load->view('settings/overview', $data);
//        $this->load->view('templates/footer', $data); 
//     
//    }
    
    
    function listSettings(){
	  $data['page_title'] = "System Settings";      
          $data['link_title'] = "setting";
	
	 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
         $this->load->view('settings/overview', $data);
        $this->load->view('templates/footer', $data);
    }
    
    
    /**
     * company details
     */
    function companyDetails(){
        $data['page_title'] = "Company Details";      
        $data['link_title'] = "setting";          
        $data['sublink_title'] = "comp-details";
         
       
        $data['settings'] = $settings = $this->setting_accessor->getSettings();
        
          // define the links that  would be displayed in the page header area
          
       if($this->input->post('save_company_details')):
          
       //     setting_company_name  setting_company_address_1 setting_company_address_2
       //  setting_company_address_3  setting_company_town setting_company_county
       //  setting_company_postcode  setting_company_country
            $this->form_validation->set_rules('setting_company_name', 'Company Name', 'required');
            $this->form_validation->set_rules('setting_company_address_1', 'Address', 'required');
            $this->form_validation->set_rules('setting_company_town', 'Town', 'required');
            $this->form_validation->set_rules('setting_company_county', 'County/Region', 'required');
            $this->form_validation->set_rules('setting_company_postcode', 'Postcode', 'required');
            $this->form_validation->set_rules('setting_company_country', 'Country', 'required');
            
            $this->form_validation->set_error_delimiters( '<em class="error_text">','</em>' );
            
             if($this->form_validation->run()):
                 
                    $content['setting_company_name'] = $this->input->post('setting_company_name');
                    $content['setting_company_address_1'] = $this->input->post('setting_company_address_1');
                    $content['setting_company_address_2'] = $this->input->post('setting_company_address_2');
                    $content['setting_company_address_3'] = $this->input->post('setting_company_address_3');
                    $content['setting_company_town'] = $this->input->post('setting_company_town');
                    $content['setting_company_postcode'] = $this->input->post('setting_company_postcode');
                    $content['setting_company_county'] = $this->input->post('setting_company_county');
                    $content['setting_company_country'] = $this->input->post('countries_list_countryID');
                  
                    if(empty($settings)):
                        $this->setting_accessor->createSettings($content);
                    else:
                        $this->setting_accessor->updateSettings($content, array('settingsID'=>$settings->settingsID));
                    endif;
                     
                   // if($settingID):
                        
                         $this->session->set_flashdata('message', 'Settings Saved');
                         $this->session->set_flashdata('type', 'flash_success');
                        redirect(base_url('settings'));  
                   // else:
                       // $data['db_error'] = "There was add this IFA/Company Details. Please try again";
                        
                   // endif;
             
                   
            endif;
              
        endif;
         
         $data['settings'] = $this->setting_accessor->getSettings();
        // print_r($data['settings']);
      
        $this->load->view('templates/header', $data);
         $this->load->view('templates/navbar', $data);
        $this->load->view('settings/company-details-form', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
    
    function companyLogo(){
        
        /**
         * before you are upload logo, let make sure you have at leat define the company name first
         * because we are basically updating here not inserting
         */
        
        $data['settings'] = $settings = $this->setting_accessor->getSettings();
        
        if(empty($settings)):
             $this->session->set_flashdata('message', 'Please you need to update the company details first');
             $this->session->set_flashdata('type', 'flash_error');
             redirect(base_url('settings/company-details')); 
             exit();
        endif;
        
        
        
        
        $data['page_title'] = "Site Logo and Invoice Logos";      
        $data['link_title'] = "setting";          
        $data['sublink_title'] = "comp-details";
         
        //create the uploads directory if not exist
        fileHelp_mkdir('images/settings');
        
        
        /** UPDATE SITE LOGO**/
        if($this->input->post('upload_site_logo')):
            
            $required = ( empty($_FILES['site_logo']['name']) ? "required" : "");           
            $this->form_validation->set_rules('site_logo', 'File', "$required");
            $this->form_validation->set_rules('site_logo_ref', 'Reff', "required");
            
             $this->form_validation->set_error_delimiters( '<em class="error_text">','</em>' );
            
              
             if($this->form_validation->run()):
                 
                $config['upload_path'] = './images/settings/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['encrypt_name'] = TRUE;
                $config['remove_spaces'] = TRUE;
//                $config['max_size'] = '100';
//                $config['max_width'] = '1024';
//                $config['max_height'] = '768';
                $this->load->library('upload', $config);
                        
                if ( ! $this->upload->do_upload('site_logo')):
                   $data['site_logo_upload_error'] = $this->upload->display_errors();                   
                    
                else:
                   $upload_data =  $this->upload->data();
                   $content['setting_company_logo_path'] = "images/settings/".$upload_data['file_name'];
                     
                        $this->setting_accessor->updateSettings($content, array('settingsID'=>$settings->settingsID));
                
                         $this->session->set_flashdata('message', 'Logo Saved');
                         $this->session->set_flashdata('type', 'flash_success');
                        redirect(base_url('settings/company-logo')); 
                endif;          
             endif;
            
        endif;
         
        //##################################################################//
        /** UPDATE INVOICE  LOGO**/
        if($this->input->post('upload_invoice_logo')):
            
            $required = ( empty($_FILES['invoice_logo']['name']) ? "required" : "");           
            $this->form_validation->set_rules('invoice_logo', 'File', "$required");
            $this->form_validation->set_rules('invoice_logo_ref', 'Reff', "required");
            
             $this->form_validation->set_error_delimiters( '<em class="error_text">','</em>' );
            
              
             if($this->form_validation->run()):
                 
                $config['upload_path'] = './images/settings/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['encrypt_name'] = TRUE;
                $config['remove_spaces'] = TRUE;
//                $config['max_size'] = '100';
//                $config['max_width'] = '1024';
//                $config['max_height'] = '768';
                $this->load->library('upload', $config);
                        
                if ( ! $this->upload->do_upload('invoice_logo')):
                   $data['invoice_logo_upload_error'] = $this->upload->display_errors();                   
                    
                else:
                   $upload_data =  $this->upload->data();
                   $content['setting_company_invoice_logo_path'] = "images/settings/".$upload_data['file_name'];
                     
                        $this->setting_accessor->updateSettings($content, array('settingsID'=>$settings->settingsID));
                
                         $this->session->set_flashdata('message', 'Logo Saved');
                         $this->session->set_flashdata('type', 'flash_success');
                        redirect(base_url('settings/company-logo')); 
                endif;          
             endif;
            
        endif;
        
        
        
        
         //##################################################################//
        /** UPDATE INVOICE  HEADER **/
        if($this->input->post('upload_invoice_header')):
            
            $required = ( empty($_FILES['invoice_header']['name']) ? "required" : "");           
            $this->form_validation->set_rules('invoice_header', 'File', "$required");
            $this->form_validation->set_rules('invoice_header_ref', 'Reff', "required");
            
             $this->form_validation->set_error_delimiters( '<em class="error_text">','</em>' );
            
              
             if($this->form_validation->run()):
                 
                $config['upload_path'] = './images/settings/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['encrypt_name'] = TRUE;
                $config['remove_spaces'] = TRUE;
//                $config['max_size'] = '100';
//                $config['max_width'] = '1024';
//                $config['max_height'] = '768';
                $this->load->library('upload', $config);
                        
                if ( ! $this->upload->do_upload('invoice_header')):
                   $data['invoice_header_upload_error'] = $this->upload->display_errors();                   
                    
                else:
                   $upload_data =  $this->upload->data();
                   $content['setting_company_invoice_header_path'] = "images/settings/".$upload_data['file_name'];
                     
                        $this->setting_accessor->updateSettings($content, array('settingsID'=>$settings->settingsID));
                
                         $this->session->set_flashdata('message', 'Logo Saved');
                         $this->session->set_flashdata('type', 'flash_success');
                        redirect(base_url('settings/company-logo')); 
                endif;          
             endif;
            
        endif;
        
        
        
          //##################################################################//
        /** UPDATE INVOICE  FOOTER **/
        if($this->input->post('upload_invoice_footer')):
            
            $required = ( empty($_FILES['invoice_footer']['name']) ? "required" : "");           
            $this->form_validation->set_rules('invoice_footer', 'File', "$required");
            $this->form_validation->set_rules('invoice_header_ref', 'Reff', "required");
            
             $this->form_validation->set_error_delimiters( '<em class="error_text">','</em>' );
            
              
             if($this->form_validation->run()):
                 
                $config['upload_path'] = './images/settings/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['encrypt_name'] = TRUE;
                $config['remove_spaces'] = TRUE;
//                $config['max_size'] = '100';
//                $config['max_width'] = '1024';
//                $config['max_height'] = '768';
                $this->load->library('upload', $config);
                        
                if ( ! $this->upload->do_upload('invoice_footer')):
                   $data['invoice_footer_upload_error'] = $this->upload->display_errors();                   
                    
                else:
                   $upload_data =  $this->upload->data();
                   $content['setting_company_invoice_footer_path'] = "images/settings/".$upload_data['file_name'];
                     
                        $this->setting_accessor->updateSettings($content,array('settingsID'=>$settings->settingsID));
                
                         $this->session->set_flashdata('message', 'Logo Saved');
                         $this->session->set_flashdata('type', 'flash_success');
                        redirect(base_url('settings/company-logo')); 
                endif;          
             endif;
            
        endif;
         
         
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('settings/company-logos-form', $data);
        $this->load->view('templates/footer', $data); 
    }
    
    
    
    /**
     * delelette site images
     */
    function deleteSiteImages($type = ""){
        
        if(empty($type)):
             $this->session->set_flashdata('message', 'Invalid settings detected');
             $this->session->set_flashdata('type', 'flash_error');
             redirect(base_url('settings/company-details')); 
             exit();
        endif;
        
        $settings = $this->setting_accessor->getSettings();
        
        switch ($type) {
            case 'site-logo':
                    $content['setting_company_logo_path'] = "";
                    $this->setting_accessor->updateSettings($content, array('settingsID'=>$settings->settingsID));

                    fileHelp_unlink_file($settings->setting_company_logo_path);

                    $this->session->set_flashdata('message', 'Setting updated');
                    $this->session->set_flashdata('type', 'flash_success');
                break;
            
            case 'invoice-logo':
                    $content['setting_company_invoice_logo_path'] = "";
                    $this->setting_accessor->updateSettings($content, array('settingsID'=>$settings->settingsID));

                    fileHelp_unlink_file($settings->setting_company_invoice_logo_path);

                    $this->session->set_flashdata('message', 'Setting updated');
                    $this->session->set_flashdata('type', 'flash_success');
                break;
            
             case 'invoice-header':
                    $content['setting_company_invoice_header_path'] = "";
                    $this->setting_accessor->updateSettings($content, array('settingsID'=>$settings->settingsID));

                    fileHelp_unlink_file($settings->setting_company_invoice_header_path);

                    $this->session->set_flashdata('message', 'Setting updated');
                    $this->session->set_flashdata('type', 'flash_success');
                break;
            
             case 'invoice-footer':
                    $content['setting_company_invoice_footer_path'] = "";
                    $this->setting_accessor->updateSettings($content, array('settingsID'=>$settings->settingsID));

                    fileHelp_unlink_file($settings->setting_company_invoice_footer_path);

                    $this->session->set_flashdata('message', 'Setting updated');
                    $this->session->set_flashdata('type', 'flash_success');
                break;

            default:
                break;
        }
        
       
        
         redirect(base_url('settings/company-logo')); 
        
    }
    
    
    
    
    /**
     * select the theme to use in invoices
     * choose whether to use an invoice logo or header text or nothing
     */
    function selectInvoiceTheme(){
        $data['page_title'] = "Select Invoice Theme";      
        $data['link_title'] = "setting";          
       // $data['sublink_title'] = "comp-details";
         
       
        $data['settings'] = $settings = $this->setting_accessor->getSettings();
        
          // define the links that  would be displayed in the page header area
          
       if($this->input->post('save_invoice_theme')):

            $this->form_validation->set_rules('setting_use_invoice_logo_or_header', 'Image', 'required');         
            
            $this->form_validation->set_error_delimiters( '<em class="error_text">','</em>' );
            
             if($this->form_validation->run()):
                 
                    $content['setting_use_invoice_logo_or_header'] = $this->input->post('setting_use_invoice_logo_or_header');
                                     
                    if(empty($settings)):
                        $this->setting_accessor->createSettings($content);
                    else:
                        $this->setting_accessor->updateSettings($content, array('settingsID'=>$settings->settingsID));
                    endif;
                     
                   // if($settingID):
                        
                         $this->session->set_flashdata('message', 'Settings Saved');
                         $this->session->set_flashdata('type', 'flash_success');
                        redirect(base_url('settings'));  
                   // else:
                       // $data['db_error'] = "There was add this IFA/Company Details. Please try again";
                        
                   // endif;
             
                   
            endif;
              
        endif;
         
         $data['settings'] = $this->setting_accessor->getSettings();
  
        $this->load->view('templates/header', $data);
         $this->load->view('templates/navbar', $data);
        $this->load->view('settings/invoice-theme-form', $data);
        $this->load->view('templates/footer', $data); 
    }
    
}
