<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>



   <div class="">

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
	<label for="rule" class="col-sm-3 control-label">Rule</label>
	<div class="col-sm-9">
	     <?php
	       $data = array(
		 'name'        => 'rule',
		 'id'          => 'rule',
		 //'value'       => set_value('rule', (!empty($wrapper)) ? $wrapper->wrapperName : ''),
		 'class'       => 'field form-control',
		 'required'  =>'required'
		);

	     echo form_input($data);
	     ?>
	</div>                   
   </div>
    <div class="form-group row required">	    
	<label for="wrapperRuleDesc" class="col-sm-3 control-label">Description</label>
	<div class="col-sm-9">
	     <?php
	       $data = array(
		 'name'        => 'wrapperRuleDesc',
		 'id'          => 'wrapperRuleDesc',
		// 'value'       => set_value('rule', (!empty($wrapper)) ? $wrapper->wrapperName : ''),
		 'class'       => 'field form-control',
		 'required'  =>'required',
		 'rows'=>5
		);

	     echo form_textarea($data);
	     ?>
	</div>                   
   </div>

   <div class="form-group">
      <label for="" class="col-sm-3 control-label">  </label>
      <?php if($mode == "new"):?>
	   <button name="add_rule" class="btn btn-success" value="Add"> Add
	  <span class="glyphicon glyphicon-"></span>
       </button>
      <?php elseif($mode== "edit"):?>

	   <button name="add_rule" class="btn btn-success" value="edit"> Update 		    <span class="glyphicon glyphicon-"></span>
	   </button>
      <?php endif;?>



   </div>



   <?php echo form_close()?>

   </div>

