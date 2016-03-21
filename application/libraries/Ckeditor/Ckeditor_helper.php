<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ckeditor_helper
 *
 * @author itischarles
 */
class Ckeditor_helper{
    //put your code here
    
    
    
//    function __construct() {
//	parent::__construct();
//	
//
//    }
//    
    
    
        function ckeditor_1(){
	    
	 $CI = get_instance();
	 
	 $CI->load->library('Ckeditor/Ckeditor');
	
	$CI->ckeditor->basePath = base_url().'third_party/ckeditor/';
	$CI->ckeditor->config['toolbar'] = array(
	    array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste',
	    'PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
							    );
	
	//$this->ckeditor->config['language'] = 'en';
	//$this->ckeditor->config['width'] = '730px';
	//$this->ckeditor->config['height'] = '300px';
    }
    
}
