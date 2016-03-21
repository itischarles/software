<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


 
 
<div class="container-fluid">

      <div class="row page-width">
	
	 <div class="col-md-3 sidebar">
        <?php $this->load->view('wrappers/wrapper-sidebar');?>
        </div>
	
	<div class="col-md-9  bg-white">
	 <div class="content">
	
	  <h3 class="page-title"><?php echo $page_title?></h3>
      
        <?php echo form_open('', array('class'=>"form form-horizontal col-70"))?>
        
        
        <p class="text-right">
	    <span class="red-notice">The fields marked * are required</span>
	</p>
        
        <?php if(validation_errors()): ?>
	
	    <div class="alert-danger alert text-center">
		<?php echo validation_errors()?>
	    </div>
	
	<?php endif;?>
        
	
	
	 
        <div class="form-group row required">	    
	     <label for="wrapper_name" class="col-sm-3 control-label">Name</label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'wrapper_name',
		      'id'          => 'wrapper_name',
		      'value'       => set_value('wrapper_name', (!empty($wrapper)) ? $wrapper->wrapperName : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	
        
	<div class="form-group row required">	    
	     <label for="Reference" class="col-sm-3 control-label">Reference </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'Reference',
		      'id'          => 'Reference',
		      'value'       => set_value('Reference', (!empty($wrapper)) ? $wrapper->wrapperRef : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	
	
	
	<p>&nbsp;</p>
	<div class="form-group">
           <label for="" class="col-sm-3 control-label">  </label>
	   <?php if($mode == "new"):?>
		<button name="add_new_wrapper" class="btn btn-primary-2" value="Add"> Add New Wrapper
	       <span class="glyphicon glyphicon-"></span>
	    </button>
	   <?php elseif($mode== "edit"):?>
	   
		<button name="update_new_wrapper" class="btn btn-primary-2" value="edit"> Update Wrapper
		    <span class="glyphicon glyphicon-"></span>
		</button>
	   <?php endif;?>
	   
	   

        </div>
       
      
	
        <?php echo form_close()?>
       
    </div>
        
	</div>
    </div>
    
</div>