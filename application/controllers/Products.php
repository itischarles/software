<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Products
 *
 * @author itischarles
 */
class Products extends MY_Controller {
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
    
    
    
    
    function addProduct($wrapperBaseUrl){
	$data['wrapper'] = $wrapper = $this->wrapper_accssor->getRecordByURL($wrapperBaseUrl);
	
	if(empty($wrapper)):	
             $this->session->set_flashdata('message', 'Wrapper Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	 
	

	if($this->input->post('add_product')):

	    $this->form_validation->set_rules('product', 'Product', 'trim|required|is_unique[products.productName]');
	  //  $this->form_validation->set_rules('wrapperRuleDesc', 'Description', 'trim|required');
	  
             if($this->form_validation->run()):
	
		$content['productName']= $this->input->post('product');
		$content['productBaseUrl']= $productBaseUrl = $this->product_accessor->generateUrl();
		$content['wrappers_wrapperID']= $wrapper->wrapperID;
		$content['productIsActive']= 1;
		
		$this->product_accessor->addNewProduct($content);
		
		
		$this->session->set_flashdata('message', 'Record Created');
		$this->session->set_flashdata('type', 'flash_success');
	      //  redirect(base_url('wrapper/'.$wrapperBaseUrl."/product/$productBaseUrl")); 
               redirect(base_url('wrapper/'.$wrapperBaseUrl)); 
	     endif;
	     
	    
	
	endif;
	
	
	$data['mode'] = "new";
	$data['show_wrapper_rules_link'] = "true";
	$data['show_products_link'] = "true";
	
	
	
	$data['page_title'] = "Wrapper - ".$wrapper->wrapperName;       
	$data['link_title'] = "setting";  
	
	//$data['wrapper_rules'] = $this->wrapper_accssor->listWrapperRulesByWhere(
	//	array('wrapper_rules.wrappers_wrapperID'=>$wrapper->wrapperID));
//
	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('products/form-product', $data);
	$this->load->view('templates/footer', $data);
    }
    
    
    
    function viewProduct($wrapperBaseUrl, $productURL){
	$data['wrapper'] = $wrapper = $this->wrapper_accssor->getRecordByURL($wrapperBaseUrl);
	$data['product'] = $product = $this->product_accessor->getRecordByURL($productURL);
	
	if(empty($wrapper)|| empty($product)):	
             $this->session->set_flashdata('message', 'Product Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	
	$data['mode'] = "new";
	$data['show_wrapper_rules_link'] = "true";
	$data['show_products_link'] = "true";
	
	
	
	$data['page_title'] = "Wrapper - ".$wrapper->wrapperName;       
	$data['link_title'] = "setting";  

//
	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('products/view-product', $data);
	$this->load->view('templates/footer', $data);
	
	
    }
    
    
    
    
    function editProduct($wrapperBaseUrl, $productURL){
	$data['wrapper'] = $wrapper = $this->wrapper_accssor->getRecordByURL($wrapperBaseUrl);
	$data['product'] = $product = $this->product_accessor->getRecordByURL($productURL);
	
	if(empty($wrapper)|| empty($product)):	
             $this->session->set_flashdata('message', 'Product Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	
	if($this->input->post('update_product')):
	    $is_unique = '';
	    if($this->input->post('product') != $product->productName):
		$is_unique =  '|is_unique[products.productName]';
	    endif;

	    $this->form_validation->set_rules('product', 'Product', 'trim|required'.$is_unique);
	  //  $this->form_validation->set_rules('wrapperRuleDesc', 'Description', 'trim|required');
	  
             if($this->form_validation->run()):
	
		$content['productName']= $this->input->post('product');
		//$content['productBaseUrl']= $productBaseUrl = $this->product_accessor->generateUrl();
		//$content['wrappers_wrapperID']= $wrapper->wrapperID;
		//$content['productIsActive']= 1;
		
		$where['productID']= $product->productID;
		$where['wrappers_wrapperID']= $wrapper->wrapperID;
		$this->product_accessor->updateProduct($content,$where);
		
		
		$this->session->set_flashdata('message', 'Record updated');
		$this->session->set_flashdata('type', 'flash_success');
	       // redirect(base_url('wrapper/'.$wrapperBaseUrl."/product/$productURL")); 
               redirect(base_url('wrapper/'.$wrapperBaseUrl)); 
	     endif;
	     
	    
	
	endif;
	
	
	$data['mode'] = "edit";
	$data['show_wrapper_rules_link'] = "true";
	$data['show_products_link'] = "true";
	
	
	
	$data['page_title'] = "Wrapper - ".$wrapper->wrapperName;       
	$data['link_title'] = "setting";  
	
	//$data['wrapper_rules'] = $this->wrapper_accssor->listWrapperRulesByWhere(
	//	array('wrapper_rules.wrappers_wrapperID'=>$wrapper->wrapperID));
//
	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('products/form-product', $data);
	$this->load->view('templates/footer', $data);
	
    }
    
    
    
    
    
    
    
    /*******PRODUCT OPTIONS *****************/
    
    /**
     * 
     * $wrapperBaseUrl string wrapperBaseUrl - url of the wrapper
     * $product type $product. i am not using route so three param get sent here from the url
     * $productURL type $productURL the product url we wwant to add options to
     */
    function addProductOptions($wrapperBaseUrl,$productURL){
	$data['wrapper'] = $wrapper = $this->wrapper_accssor->getRecordByURL($wrapperBaseUrl);
	$data['product'] = $product = $this->product_accessor->getRecordByURL($productURL);
	
	
	if(empty($wrapper)|| empty($product)):	
             $this->session->set_flashdata('message', 'Product Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	
	if($this->input->post('add_product_option')):
//	    $is_unique = '';
//	    if($this->input->post('product') != $product->productName):
//		$is_unique =  '|is_unique[products.productName]';
//	    endif;

	  //  $this->form_validation->set_rules('product', 'Product', 'trim|required'.$is_unique);
	    $this->form_validation->set_rules('optionName', 'Option Name', 'trim|required|is_unique[product_options.productOptionName]');
	  
             if($this->form_validation->run()):
	
		$content['productOptionName']= $this->input->post('optionName');	     
		$content['products_productID']= $product->productID;
		
		//$where['productID']= $product->productID;
		//$where['wrappers_wrapperID']= $wrapper->wrapperID;
		$this->product_accessor->addNewProductOption($content);
		
		
		$this->session->set_flashdata('message', 'Record updated');
		$this->session->set_flashdata('type', 'flash_success');
	       // redirect(base_url('wrapper/'.$wrapperBaseUrl."/product/$productURL")); 
               redirect(base_url('wrapper/'.$wrapperBaseUrl)); 
	     endif;
	     
	    
	
	endif;
	
	
	
	$data['mode'] = "new";
	$data['show_wrapper_rules_link'] = "true";
	$data['show_products_link'] = "true";
	
	
	
	$data['page_title'] = "Wrapper - ".$wrapper->wrapperName;       
	$data['link_title'] = "setting";  
	
	//$data['wrapper_rules'] = $this->wrapper_accssor->listWrapperRulesByWhere(
	//	array('wrapper_rules.wrappers_wrapperID'=>$wrapper->wrapperID));
//
	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('products/form-product-options', $data);
	$this->load->view('templates/footer', $data);
    }
    
    
        /**
     * 
     * $wrapperBaseUrl string wrapperBaseUrl - url of the wrapper
     * $product type $product. i am not using route so three param get sent here from the url
     * $productURL type $productURL the product url we wwant to add options to
     */
    function updateProductOptions($wrapperBaseUrl,$productURL, $optionID){
	$data['wrapper'] = $wrapper = $this->wrapper_accssor->getRecordByURL($wrapperBaseUrl);
	$data['product'] = $product = $this->product_accessor->getRecordByURL($productURL);
	
	if(empty($wrapper)|| empty($product)):	
             $this->session->set_flashdata('message', 'Product Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	$data['productOption'] = $productOption = $this->product_accessor->getProductOptionByWhere(
		array('product_options.productOptionsID'=>$optionID,'product_options.products_productID'=>$product->productID ));
	
	if(empty($productOption)):	
             $this->session->set_flashdata('message', 'Product Option Not found!!!');
             $this->session->set_flashdata('type', 'flash_error');
             redirect($_SERVER['HTTP_REFERER']); 
        endif;
	
	if($this->input->post('update_product_option')):
	    $is_unique = '';
	    if($this->input->post('optionName') != $productOption->productOptionName):
		$is_unique =  '|is_unique[product_options.productOptionName]';
	    endif;

	  //  $this->form_validation->set_rules('product', 'Product', 'trim|required'.$is_unique);
	    $this->form_validation->set_rules('optionName', 'Option Name', 'trim|required'.$is_unique);
	  
             if($this->form_validation->run()):
	
		$content['productOptionName']= $this->input->post('optionName');	     
		//$content['products_productID']= $product->productID;
		
		$where['products_productID']= $product->productID;
		$where['productOptionsID']= $productOption->productOptionsID;
		$this->product_accessor->updateProductOption($content, $where);
		
		
		$this->session->set_flashdata('message', 'Record updated');
		$this->session->set_flashdata('type', 'flash_success');
	       // redirect(base_url('wrapper/'.$wrapperBaseUrl."/product/$productURL")); 
               redirect(base_url('wrapper/'.$wrapperBaseUrl)); 
	     endif;
	     
	    
	
	endif;
	
	
	
	$data['mode'] = "edit";
	$data['show_wrapper_rules_link'] = "true";
	$data['show_products_link'] = "true";
	
	
	
	$data['page_title'] = "Wrapper - ".$wrapper->wrapperName;       
	$data['link_title'] = "setting";  
	
	//$data['wrapper_rules'] = $this->wrapper_accssor->listWrapperRulesByWhere(
	//	array('wrapper_rules.wrappers_wrapperID'=>$wrapper->wrapperID));
//
	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $data);
	$this->load->view('products/form-product-options', $data);
	$this->load->view('templates/footer', $data);
    }
    
    
}
