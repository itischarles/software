<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


 
 
<div class="container-fluid">

      <div class="row  page-width">
	
	 <div class="col-md-3 sidebar">
         <?php $this->load->view('financial-adviser/fa-sidebar');?>
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
	     <label for="adviserCompanyNetworkReference" class="col-sm-3 control-label">Network Reference</label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyNetworkReference',
		      'id'          => 'adviserCompanyNetworkReference',
		      'value'       => set_value('adviserCompanyNetworkReference', (!empty($adviserCompanyNetwork)) ? $adviserCompanyNetwork->adviserCompanyNetworkReference : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
        
        <div class="form-group row required">	    
	     <label for="adviserCompanyNetworkName" class="col-sm-3 control-label">Network Name</label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyNetworkName',
		      'id'          => 'adviserCompanyNetworkName',
		      'value'       => set_value('adviserCompanyNetworkName', (!empty($adviserCompanyNetwork)) ? $adviserCompanyNetwork->adviserCompanyNetworkName : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	
        
	<div class="form-group row required">	    
	     <label for="adviserCompanyNetworkAddress1" class="col-sm-3 control-label">Address Line 1 </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyNetworkAddress1',
		      'id'          => 'adviserCompanyNetworkAddress1',
		      'value'       => set_value('adviserCompanyNetworkAddress1', (!empty($adviserCompanyNetwork)) ? $adviserCompanyNetwork->adviserCompanyNetworkAddress1 : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group row ">	    
	     <label for="adviserCompanyNetworkAddress2" class="col-sm-3 control-label">Address Line 2   </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyNetworkAddress2',
		      'id'          => 'adviserCompanyNetworkAddress2',
		      'value'       => set_value('adviserCompanyNetworkAddress2', (!empty($adviserCompanyNetwork)) ? $adviserCompanyNetwork->adviserCompanyNetworkAddress2 : ''),
		      'class'       => 'field form-control',
		    
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group row">	    
	     <label for="adviserCompanyNetworkAddress3" class="col-sm-3 control-label">Address Line 3  </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyNetworkAddress3',
		      'id'          => 'adviserCompanyNetworkAddress3',
		      'value'       => set_value('adviserCompanyNetworkAddress3', (!empty($adviserCompanyNetwork)) ? $adviserCompanyNetwork->adviserCompanyNetworkAddress3 : ''),
		      'class'       => 'field form-control',
		    
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group row required">	    
	     <label for="adviserCompanyNetworkCity" class="col-sm-3 control-label">Town/City  </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyNetworkCity',
		      'id'          => 'adviserCompanyNetworkCity',
		      'value'       => set_value('adviserCompanyNetworkCity', (!empty($adviserCompanyNetwork)) ? $adviserCompanyNetwork->adviserCompanyNetworkCity : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group row required">	    
	     <label for="adviserCompanyNetworkCounty" class="col-sm-3 control-label">County/Region </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyNetworkCounty',
		      'id'          => 'adviserCompanyNetworkCounty',
		      'value'       => set_value('adviserCompanyNetworkCounty', (!empty($adviserCompanyNetwork)) ? $adviserCompanyNetwork->adviserCompanyNetworkCounty : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group row required">	    
	     <label for="adviserCompanyNetworkPostcode" class="col-sm-3 control-label">Postcode </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyNetworkPostcode',
		      'id'          => 'adviserCompanyNetworkPostcode',
		      'value'       => set_value('adviserCompanyNetworkPostcode', (!empty($adviserCompanyNetwork)) ? $adviserCompanyNetwork->adviserCompanyNetworkPostcode : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	
	
	<div class="form-group row required">	    
	     <label for="adviserCompanyNetworkEmail" class="col-sm-3 control-label">Email </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyNetworkEmail',
		      'id'          => 'adviserCompanyNetworkEmail',
		      'value'       => set_value('adviserCompanyNetworkEmail', (!empty($adviserCompanyNetwork)) ? $adviserCompanyNetwork->adviserCompanyNetworkEmail : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>

	
	<div class="form-group row">	    
	     <label for="adviserCompanyNetworkTel" class="col-sm-3 control-label">Telephone </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyNetworkTel',
		      'id'          => 'adviserCompanyNetworkTel',
		      'value'       => set_value('adviserCompanyNetworkTel', (!empty($adviserCompanyNetwork)) ? $adviserCompanyNetwork->adviserCompanyNetworkTel : ''),
		      'class'       => 'field form-control',
		     
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>

	
	
	<p>&nbsp;</p>
	<div class="form-group">
           <label for="" class="col-sm-3 control-label">  </label>
	   <?php if($mode == "new"):?>
		<button name="add_companyNetwork" class="btn btn-primary-2" value="Add"> Add New Company Network
	       <span class="glyphicon glyphicon-"></span>
	    </button>
	   <?php elseif($mode== "edit"):?>
	   
		<button name="update_companyNetwork" class="btn btn-primary-2" value="edit"> Update  Company Network
		    <span class="glyphicon glyphicon-"></span>
		</button>
	   <?php endif;?>
	   
	   

        </div>
       
      
	
        <?php echo form_close()?>
       
    </div>
        
	</div>
    </div>
    
</div>