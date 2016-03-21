<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


 
 
<div class="container-fluid ">

      <div class="row page-width">
	
	  
	  
	 <div class="col-md-3 sidebar">
           <?php $this->load->view('wrappers/wrapper-sidebar');?>
        </div>
	
	<div class="col-md-9  bg-white">
	 <div class="content">
	       <h3 class="page-title">Wrappers & Accounts</h3>
	       <table class="table table-responsive col-70 table-striped">
		<tr>
		    <th>Wrapper Name</th>
		    <td><?php    echo $wrapper->wrapperName ?></td>
		</tr>
		 <tr>
		    <th>Wrapper Reference</th>
		    <td><?php    echo $wrapper->wrapperRef ?></td>
		</tr>
		 <tr>
		    <th>Status</th>
		    <td><?php    echo writeStatusIsActive($wrapper->wrapperIsActive) ?></td>
		</tr>


	    </table>

	         <!-- product-->
	       <div>
		   <h3 class="page-title">Product</h3>
	       <table class="table table-responsive col-70 table-striped">
		<tr>
		    <th>Product Name</th>
		    <td><?php    echo $product->productName ?></td>
		</tr>
		 <tr>
		    <th>Product Reference</th>
		    <td><?php    //echo $wrapper->wrapperRef ?></td>
		</tr>
		

	    </table>

	       </div>   
	       
	    <!--  end product-->
	     
	    <div class="">
		<h3 class="page-title"><?php echo ucfirst($mode)." Product Option"?></h3>
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
		     <label for="optionName" class="col-sm-3 control-label">Option Name</label>
		     <div class="col-sm-9">
			  <?php
			    $data = array(
			      'name'        => 'optionName',
			      'id'          => 'optionName',
			      'value'       => set_value('rule', (!empty($productOption)) ? $productOption->productOptionName : ''),
			      'class'       => 'field form-control',
			      'required'  =>'required'
			     );

			  echo form_input($data);
			  ?>
		     </div>                   
		</div>
		

		<div class="form-group">
		    <p></p>
		   <label for="" class="col-sm-3 control-label">  </label>
		   <?php if($mode == "new"):?>
			<button name="add_product_option" class="btn btn-primary-2" value="Add"> Add
		       <span class="glyphicon glyphicon-"></span>
		    </button>
		   <?php elseif($mode== "edit"):?>

			<button name="update_product_option" class="btn btn-primary-2" value="edit"> Update <span class="glyphicon glyphicon-"></span>
			</button>
		   <?php endif;?>


		   <a href="<?php echo base_url('wrapper/'.$wrapper->wrapperBaseUrl) ?>" class="btn btn-primary-2">Cancel</a>

		</div>



   <?php echo form_close()?>

   </div>
	       
	       
	     
       
    </div>
        
	</div>
    </div>
    
</div>