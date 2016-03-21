<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="container-fluid bg-gray-light">

<?php //echo validation_errors() ?>
    <div class="row ">
	
	<div class="col-md-3 sidebar">
           <?php $this->load->view('search/sidebar');?>
        </div>
	
	
	<div class="col-md-9  bg-white">
	      <h3 class="page-title">Find Your Client</h3>
	      
	       <?php echo form_open('', array('class'=>"form form-horizontal col-70"))?>
        
        
		

		<?php if(validation_errors()): ?>
		<div class="form-group">
		    <div class="alert-danger alert">
			<?php echo validation_errors()?>
		    </div>
		</div>
		<?php endif;?>

        
        <div class="form-group row">	    
	     <label for="userFirstName" class="col-sm-3 control-label">First Name</label>
	     <div class="col-sm-9">
		 <input type="text" name="userFirstName" value="<?php echo $this->input->post('userFirstName')?>"
			id="userFirstName" class="field form-control"/>

	     </div>                   
        </div>
	
	
	<div class="form-group row ">	    
	     <label for="userLastName" class="col-sm-3 control-label">Last Name </label>
	     <div class="col-sm-9">
		  <input type="text" name="userLastName" value="<?php echo $this->input->post('userLastName')?>"
			id="userLastName" class="field form-control"/>
		 
	     </div>                   
        </div>
	
	
	<div class="form-group row">	    
	     <label for="dob" class="col-sm-3 control-label">Date of Birth </label>
	     <div class="col-sm-9">
		 <input type="text" name="dob" value="<?php echo $this->input->post('dob')?>"
			id="dob" class="field form-control" placeholder="dd/mm/yyyy"/>
		
	     </div>                   
        </div>
	<div class="form-group row">	    
	     <label for="ni_number" class="col-sm-3 control-label">NI Number </label>
	     <div class="col-sm-9">
		 <input type="text" name="ni_number" value="<?php echo $this->input->post('ni_number')?>"
			id="ni_number" class="field form-control"/>
		  
	     </div>                   
        </div>
 
	<div class="form-group row">	    
	     <label for="userPostcode" class="col-sm-3 control-label">Postcode </label>
	     <div class="col-sm-9">
		 <input type="text" name="userPostcode" value="<?php echo $this->input->post('userPostcode')?>"
			id="userPostcode" class="field form-control" placeholder="ng1 1od"/>
		  
	     </div>                   
        </div>
	
	
	
	
	
	
	<p>&nbsp;</p>
	<div class="form-group">
           <label for="" class="col-sm-3 control-label">  </label>
	   <button name="find_user" class="btn btn-success"> Find
	       <span class="glyphicon glyphicon-search"></span>
	   </button>
		
            <br/>
        </div>
       
      
	
        <?php echo form_close()?>
	</div>
    </div>
    
</div>