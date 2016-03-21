<?php

/* 
 *a starting place for all applications.
 * here is a form to list all the rules associated with the specified account and a tickbox to 
 * you read and understood the rules.
 * Also you need to say i have confirmed the details on your accounnt and the address NI etc are correct
 */
?>

 

<div class="container-fluid">

      <div class="row page-width">
	
	  
	  
	<div class="col-md-3 sidebar">
	   
            <?php $this->load->view('application/sidebar-application');?>
        </div>
	
	<div class="col-md-9  bg-white">
	 <div class="content">
	       <h3 class="page-title">Client: <?php echo $client->titleName." ".$client->clientFname." ".$client->clientLname ?> </h3>
	      
	      
	       <div>
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
			<?php if(!empty($accountRules)):?>
			<ul>
			<?php foreach($accountRules as $key=>$rules):?>
			    <li><?php echo ($rules->wrapperRuleName) ?></li>
			<?php endforeach;?>
			</ul>
			<?php endif;?>
		    </div>
		    <div class="form-group  required">	
			 
			<div class="col-sm-12">
			<input type="checkbox" name="rule_understood" value="1"/>
			    I have read and understood these rules			
			</div>   
			<div class="clear"></div>
		   </div>
			
		     <div class="form-group">	
			 <p>Please make sure you are reviewed your details and are correct as at now</p>
			                
		   </div>
			
		    <div class="form-group  required">	
			 
			<div class="col-sm-12">
			<input type="checkbox" name="details_correct" value="1"/>
			    I confirm my detail is correct
			</div>
		          <div class="clear"></div>   
		   </div>
			
			
		    <div class="form-group">
		        <button name="continue" class="btn btn-primary-2" value="continue"> Continue
			   <span class="glyphicon glyphicon-ok-sign"></span>
			</button>

		    </div>

			<?php echo form_close()?>
	       </div>
       
	    </div>
        
	</div>
    </div>
    
</div>