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
         <?php $this->load->view('users/users-sidebar');?>
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
	     <label for="userFirstName" class="col-sm-3 control-label">First Name</label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userFirstName',
		      'id'          => 'userFirstName',
		      'value'       => set_value('userFirstName', (!empty($user)) ? $user->userFirstName : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group  required">	    
	     <label for="userLastName" class="col-sm-3 control-label">Last Name </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userLastName',
		      'id'          => 'userLastName',
		      'value'       => set_value('userLastName', (!empty($user)) ? $user->userLastName : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
        
	<div class="form-group  required">	    
	     <label for="userAddressLine1" class="col-sm-3 control-label">Address Line 1 </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userAddressLine1',
		      'id'          => 'userAddressLine1',
		      'value'       => set_value('userAddressLine1', (!empty($user)) ? $user->userAddressLine1 : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group  ">	    
	     <label for="userAddressLine2" class="col-sm-3 control-label">Address Line 2   </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userAddressLine2',
		      'id'          => 'userAddressLine2',
		      'value'       => set_value('userAddressLine2', (!empty($user)) ? $user->userAddressLine2 : ''),
		      'class'       => 'field form-control',
		    
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group ">	    
	     <label for="userAddressLine3" class="col-sm-3 control-label">Address Line 3  </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userAddressLine3',
		      'id'          => 'userAddressLine3',
		      'value'       => set_value('userAddressLine3', (!empty($user)) ? $user->userAddressLine3 : ''),
		      'class'       => 'field form-control',
		    
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group  required">	    
	     <label for="userCity" class="col-sm-3 control-label">Town/City  </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userCity',
		      'id'          => 'userCity',
		      'value'       => set_value('userCity', (!empty($user)) ? $user->userCity : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	<div class="form-group required">	    
	     <label for="userCounty" class="col-sm-3 control-label">County/Region </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userCounty',
		      'id'          => 'userCounty',
		      'value'       => set_value('userCounty', (!empty($user)) ? $user->userCounty : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	<div class="form-group  required">	    
	     <label for="userPostcode" class="col-sm-3 control-label">Postcode </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userPostcode',
		      'id'          => 'userPostcode',
		      'value'       => set_value('userPostcode', (!empty($user)) ? $user->userPostcode : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	
	
	<div class="form-group required">	    
	     <label for="userEmail" class="col-sm-3 control-label">Email </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userEmail',
		      'id'          => 'userEmail',
		      'value'       => set_value('userEmail', (!empty($user)) ? $user->userEmail : ''),
		      'class'       => 'field form-control',
		      'required'  =>'required'
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>

	
	<div class="form-group	">	    
	     <label for="userTelephone" class="col-sm-3 control-label">Telephone </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userTelephone',
		      'id'          => 'userTelephone',
		      'value'       => set_value('userTelephone', (!empty($user)) ? $user->userTelephone : ''),
		      'class'       => 'field form-control',
		     
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>

	<div class="form-group">	    
	     <label for="userMobile" class="col-sm-3 control-label">Mobile </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userMobile',
		      'id'          => 'userMobile',
		      'value'       => set_value('userMobile', (!empty($user)) ? $user->userMobile : ''),
		      'class'       => 'field form-control',
		     
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>
	
	
	
	
	<div class="form-group">   
	    <h3>Login Details</h3>           
        </div>
	
	<div class="form-group">	    
	     <label for="userUsername" class="col-sm-3 control-label">Username </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userUsername',
		      'id'          => 'userUsername',
		      'value'       => set_value('userUsername', (!empty($user)) ? $user->userUsername : ''),
		      'class'       => 'field form-control',
		     
		     );

		  echo form_input($data);
		  ?>
	     </div>                   
        </div>

	<div class="form-group">	    
	     <label for="userPassword" class="col-sm-3 control-label">Password </label>
	     <div class="col-sm-9">
		  <?php
		    $data = array(
		      'name'        => 'userPassword',
		      'id'          => 'userPassword',
		     // 'value'       =>  '',
		      'class'       => 'field form-control',
		     
		     );

		  echo form_password($data);
		  ?>
	     </div>                   
        </div>
	
	
	<p>&nbsp;</p>
	<div class="form-group">
           <label for="" class="col-sm-3 control-label">  </label>
	   <?php if($mode == "new"):?>
		<button name="add_user" class="btn btn-primary-2" value="Add"> Add New User
	       <span class="glyphicon glyphicon-"></span>
	    </button>
	   <?php elseif($mode== "edit"):?>
	   
		<button name="update_user" class="btn btn-primary-2" value="edit"> Update User
		    <span class="glyphicon glyphicon-"></span>
		</button>
	   <?php endif;?>
	   
	   

        </div>
       
      
	
        <?php echo form_close()?>
       
    </div>
        
	</div>
    </div>
    
</div>