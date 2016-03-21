<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


 
 
<div class="container-fluid ">

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
        
	
	
	   <div class="form-group  required">	    
	     <label for="adviserCompanyNetworkID" class="col-sm-3 control-label">Company Network</label>
	     <?php $companyNetworkID = (isset($adviserCompany) ? $adviserCompany->adviserCompanyNetworkID : 0)?>
	     
	     <div class="col-sm-9">
		 <select name="adviserCompanyNetworkID">
		     <option value="0">&nbsp;</option>
		     <?php if(!empty($adviserCompanyNetwork)):?>
			<?php foreach($adviserCompanyNetwork as $key=>$facNet):?>
		     
		     <option value="<?php echo $facNet->adviserCompanyNetworkID?>" <?php echo (($companyNetworkID==$facNet->adviserCompanyNetworkID)? "selected=''selected": '') ?>>
			 <?php echo $facNet->adviserCompanyNetworkName?>
		     </option>
			<?php endforeach; ?>
		     <?php endif;?>
		 </select>
		 
	     </div>                   
        </div>
        
	<div class="form-group row required">	    
	     <label for="adviserCompanyRef" class="col-sm-3 control-label">Company Reference</label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyRef',
		      'id'          => 'adviserCompanyRef',
		      'value'       => set_value('adviserCompanyRef', (!empty($adviserCompany)) ? $adviserCompany->adviserCompanyRef : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
        <div class="form-group row required">	    
	     <label for="adviserCompanyName" class="col-sm-3 control-label">Company Name</label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyName',
		      'id'          => 'adviserCompanyName',
		      'value'       => set_value('adviserCompanyName', (!empty($adviserCompany)) ? $adviserCompany->adviserCompanyName : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	
        
	<div class="form-group row required">	    
	     <label for="adviserCompanyAddress1" class="col-sm-3 control-label">Address Line 1 </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyAddress1',
		      'id'          => 'adviserCompanyAddress1',
		      'value'       => set_value('adviserCompanyAddress1', (!empty($adviserCompany)) ? $adviserCompany->adviserCompanyAddress1 : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group row ">	    
	     <label for="adviserCompanyAddress2" class="col-sm-3 control-label">Address Line 2   </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyAddress2',
		      'id'          => 'adviserCompanyAddress2',
		      'value'       => set_value('adviserCompanyAddress2', (!empty($adviserCompany)) ? $adviserCompany->adviserCompanyAddress2 : ''),
		      'class'       => 'field form-control',
		    
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group row">	    
	     <label for="adviserCompanyAddress3" class="col-sm-3 control-label">Address Line 3  </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyAddress3',
		      'id'          => 'adviserCompanyAddress3',
		      'value'       => set_value('adviserCompanyAddress3', (!empty($adviserCompany)) ? $adviserCompany->adviserCompanyAddress3 : ''),
		      'class'       => 'field form-control',
		    
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group row required">	    
	     <label for="adviserCompanyCity" class="col-sm-3 control-label">Town/City  </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyCity',
		      'id'          => 'adviserCompanyCity',
		      'value'       => set_value('adviserCompanyCity', (!empty($adviserCompany)) ? $adviserCompany->adviserCompanyCity : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group row required">	    
	     <label for="adviserCompanyCounty" class="col-sm-3 control-label">County/Region </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyCounty',
		      'id'          => 'adviserCompanyCounty',
		      'value'       => set_value('adviserCompanyCounty', (!empty($adviserCompany)) ? $adviserCompany->adviserCompanyCounty : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group row required">	    
	     <label for="adviserCompanyPostcode" class="col-sm-3 control-label">Postcode </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyPostcode',
		      'id'          => 'adviserCompanyPostcode',
		      'value'       => set_value('adviserCompanyPostcode', (!empty($adviserCompany)) ? $adviserCompany->adviserCompanyPostcode : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	
	
	<div class="form-group row required">	    
	     <label for="adviserCompanyEmail" class="col-sm-3 control-label">Email </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyEmail',
		      'id'          => 'adviserCompanyEmail',
		      'value'       => set_value('adviserCompanyEmail', (!empty($adviserCompany)) ? $adviserCompany->adviserCompanyEmail : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>

	
	<div class="form-group row">	    
	     <label for="adviserCompanyTel" class="col-sm-3 control-label">Telephone </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'adviserCompanyTel',
		      'id'          => 'adviserCompanyTel',
		      'value'       => set_value('adviserCompanyTel', (!empty($adviserCompany)) ? $adviserCompany->adviserCompanyTel : ''),
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
		<button name="add_adviser_company" class="btn btn-primary-2" value="Add"> Add New FA Company
	       <span class="glyphicon glyphicon-"></span>
	    </button>
	   <?php elseif($mode== "edit"):?>
	   
		<button name="update_adviser_company" class="btn btn-primary-3" value="edit"> Update FA Company
		    <span class="glyphicon glyphicon-"></span>
		</button>
	   <?php endif;?>
	   
	   

        </div>
       
      
	
        <?php echo form_close()?>
       
    </div>
        
	</div>
    </div>
    
</div>