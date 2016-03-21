<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo "<pre>";print_r($client);
//echo "</pre>";
?>


 
 
<div class="container-fluid">

      <div class="row page-width">
	
	 <div class="col-md-3 sidebar">
      <?php $this->load->view('clients/clients-sidebar');?>
        </div>
	
	<div class="col-md-9  bg-white">
	 <div class="content">
	
	  <h3 class="page-title"><?php echo $page_title?></h3>
      
	  <div class="none">	     
	    
		   <ul class=" breadcrumb">
		      <li class="pull-left">1. Applicant Details</li>
		      <li class="pull-right">6</li>
		      <li class="pull-right">5</li>
		      <li class="pull-right">4</li>
		      <li class="pull-right">3</li>
		      <li class="pull-right">2</li>
		   
		      <li></li>
		</ul>
	     
	  
	      
	  </div>
	  
        <?php echo form_open('', array('class'=>"form form-horizontal col-70"))?>
        
        
        <p class="text-right">
	    <span class="red-notice">The fields marked * are required</span>
	</p>
        
        <?php if(validation_errors()): ?>
	
	    <div class="alert-danger alert text-center">
		<?php echo validation_errors()?>
	    </div>
	
	<?php endif;?>
        
        
	
	
	
	
	
	<div class="form-group">   
	    <h3>Member's Details</h3>           
        </div>
	<div class="form-group  required">	    
	     <label for="title" class="col-sm-3 control-label">Title</label>
	     <?php $title_titleID = (isset($client) ? $client->title_titleID : 0)?>
	     
	     <div class="col-sm-9">
		 <select name="title">
		    
		     <?php if(!empty($titles)):?>
			<?php foreach($titles as $key=>$title):?>
		     
		     <option value="<?php echo $title->titleID?>" <?php echo (($title_titleID==$title->titleID)? "selected=''selected": '') ?>>
			 <?php echo $title->titleName?>
		     </option>
			<?php endforeach; ?>
		     <?php endif;?>
		 </select>
		 
	     </div>                   
        </div>

  	
	<div class="form-group  required">	    
	     <label for="FirstName" class="col-sm-3 control-label">First Name</label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'FirstName',
		      'id'          => 'FirstName',
		      'value'       => set_value('FirstName', (!empty($client)) ? $client->clientFname : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group">	    
	     <label for="midName" class="col-sm-3 control-label">Middle Name</label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'midName',
		      'id'          => 'midName',
		      'value'       => set_value('midName', (!empty($client)) ? $client->clientMidName : ''),
		      'class'       => 'field form-control',
		      //'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group  required">	    
	     <label for="LastName" class="col-sm-3 control-label">Last Name </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'LastName',
		      'id'          => 'LastName',
		      'value'       => set_value('LastName', (!empty($client)) ? $client->clientLname : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group required">	    
	     <label for="dob_1" class="col-sm-3 control-label">Date Of birth </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'dob',
		      'id'          => 'dob_1',
		      'value'       => set_value('dob', (!empty($client)) ? changeDateFormat($client->clientDOB ): ''),
		      'class'       => 'field  date_width',
		     'required'  =>'required',
			'readonly'=>'readonly'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group  required">	    
	     <label for="retirementAge" class="col-sm-3 control-label">Expected Retirement Age</label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'retirementAge',
		      'id'          => 'retirementAge',
		      'value'       => set_value('retirementAge', (!empty($client)) ? $client->clientRetirementAge : ''),
		      'class'       => 'field form-control date_width',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group  required">	    
	     <label for="marital_status" class="col-sm-3 control-label">Marital Status</label>
	     <?php $maritalStatusID = (isset($client) ? $client->maritalStatusID : 0)?>
	     
	     <div class="col-sm-9">
		 <select name="marital_status">
		     <option>Please select</option>
		     <?php if(!empty($marital_status)):?>
			<?php foreach($marital_status as $key=>$ms):?>
		     
		     <option value="<?php echo $ms->maritalStatusID?>" <?php echo (($maritalStatusID==$ms->maritalStatusID)? "selected=''selected": '') ?>>
			 <?php echo $ms->maritalStatusName?>
		     </option>
			<?php endforeach; ?>
		     <?php endif;?>
		 </select>
		 
	     </div>                   
        </div>
	<div class="form-group  required">	    
	     <label for="gender" class="col-sm-3 control-label">Gender</label>
	     <?php $clientGender = (isset($client) ? $client->clientGender : '')?>
	     
	     <div class="col-sm-9">
		 <select name="gender">		    
		     <option value="F" <?php echo (($clientGender== "F")? "selected=''selected": '') ?>>Female</option>
		     <option value="M" <?php echo (($clientGender=="M")? "selected=''selected": '') ?>>Male</option>
		    
		 </select>
		 
	     </div>                   
        </div>
        
	<div class="form-group  required">	    
	     <label for="AddressLine1" class="col-sm-3 control-label">Address Line 1 </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'AddressLine1',
		      'id'          => 'AddressLine1',
		      'value'       => set_value('AddressLine1', (!empty($client)) ? $client->clientAddressLine1 : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group  ">	    
	     <label for="AddressLine2" class="col-sm-3 control-label">Address Line 2   </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'AddressLine2',
		      'id'          => 'AddressLine2',
		      'value'       => set_value('AddressLine2', (!empty($client)) ? $client->clientAddressLine2 : ''),
		      'class'       => 'field form-control',
		    
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group ">	    
	     <label for="AddressLine3" class="col-sm-3 control-label">Address Line 3  </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'AddressLine3',
		      'id'          => 'AddressLine3',
		      'value'       => set_value('AddressLine3', (!empty($client)) ? $client->clientAddressLine3 : ''),
		      'class'       => 'field form-control',
		    
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group  required">	    
	     <label for="City" class="col-sm-3 control-label">Town/City  </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'City',
		      'id'          => 'City',
		      'value'       => set_value('City', (!empty($client)) ? $client->clientCity : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>

 
	<div class="form-group required">	    
	     <label for="County" class="col-sm-3 control-label">County/Region </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'County',
		      'id'          => 'County',
		      'value'       => set_value('County', (!empty($client)) ? $client->clientCounty : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group  required">	    
	     <label for="Postcode" class="col-sm-3 control-label">Postcode </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'Postcode',
		      'id'          => 'Postcode',
		      'value'       => set_value('Postcode', (!empty($client)) ? $client->clientPostcode : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group  required">	    
	     <label for="country" class="col-sm-3 control-label">Country of Residence</label>
	     <?php $countryAlpha2 = (isset($client) ? $client->countryAlpha2 : 0)?>
	     
	     <div class="col-sm-9">
		 <select name="country">
		    
		     <?php if(!empty($countries)):?>
			<?php foreach($countries as $key=>$country):?>
		     
		     <option value="<?php echo $country->countryAlpha2?>" <?php echo (($countryAlpha2==$country->countryAlpha2)? "selected=''selected": '') ?>>
			 <?php echo $country->countryName?>
		     </option>
			<?php endforeach; ?>
		     <?php endif;?>
		 </select>
		 
	     </div>                   
        </div> 
	
	<div class="form-group required">	    
	     <label for="Email" class="col-sm-3 control-label">Email </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'Email',
		      'id'          => 'Email',
		      'value'       => set_value('Email', (!empty($client)) ? $client->clientEmail : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>

	
	<div class="form-group	">	    
	     <label for="Telephone" class="col-sm-3 control-label">Telephone </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'Telephone',
		      'id'          => 'Telephone',
		      'value'       => set_value('Telephone', (!empty($client)) ? $client->clientTelephone : ''),
		      'class'       => 'field form-control',
		     
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>

	<div class="form-group">	    
	     <label for="Mobile" class="col-sm-3 control-label">Mobile </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'Mobile',
		      'id'          => 'Mobile',
		      'value'       => set_value('userMobile', (!empty($client)) ? $client->clientMobile : ''),
		      'class'       => 'field form-control',
		     
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group required">	    
	     <label for="ni" class="col-sm-3 control-label">National Insurance Number </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'ni',
		      'id'          => 'ni',
		      'value'       => set_value('ni', (!empty($client)) ? $client->clientNI : ''),
		      'class'       => 'field form-control date_width',
		     'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	
	
	<div class="form-group  required">	    
	    <label for="employmentType" class="col-sm-3 control-label">Employment Type </label>
	     <?php $employmentTypeCode = (isset($client) ? $client->employmentTypeCode : '')?>
	     
	     <div class="col-sm-9">
		 <select name="employmentType">
		    
		     <?php if(!empty($employmentTypes)):?>
			<?php foreach($employmentTypes as $key=>$employmentType):?>
		     
		     <option value="<?php echo $employmentType->employmentTypeCode?>" <?php echo (($employmentTypeCode==$employmentType->employmentTypeCode)? "selected=''selected": '') ?>>
			 <?php echo $employmentType->employmentTypeName?>
		     </option>
			<?php endforeach; ?>
		     <?php endif;?>
		 </select>
		 
	     </div>                   
        </div> 
	
	
	<div class="form-group">
           <label for="" class="col-sm-3 control-label">  </label>
	
	   <button name="save_cdetails" class="btn btn-primary-2" value="Save"> Save
	       <span class="glyphicon glyphicon-ok-sign"></span>
	    </button>

        </div>
       
      
	
        <?php echo form_close()?>
       
    </div>
        
	</div>
    </div>
    
    
    
    
    
    
    
    <div id="searchAdviserDialog" title="Find Adviser"> 
	<?php echo form_open('', array('class'=>"form form-inline" , 'id'=>"advSearchForm"))?>	
	    <div class="form-group">
		<label for="adviser_name">Name</label>
		<input type="text" name="adviser_name" id="adviser_name" value="" class="form-control">
	    </div>
	    
<!--	    <div class="form-group">
	    <label for="ref">Ref</label>
	    <input type="adviser_ref" name="adviser_ref" id="adviser_ref" value="" class="form-control">
	    </div>-->

	    <div class="form-group">
		<span  name="s_advs" id="s_advs" value="Search" class="btn btn-primary">
		    Search <span class="glyphicon glyphicon-search"></span>
		</span>
		
	    </div>

	<?php echo form_close()?>


	<?php echo form_open('', array('class'=>"form form-inline", 'id'=>"advSearchResult"))?>	
	<div class="alert"></div>
	<table class="table">

	</table>

	<?php echo form_close()?>
    </div>
 
   
</div>





