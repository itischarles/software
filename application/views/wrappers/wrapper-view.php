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
	     <h3 class="page-title">Wrappers & Accounts: <?php    echo ucwords($wrapper->wrapperName) ?></h3>
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
	
	<div class="text-right col-70">
          
	    <a href="<?php echo base_url("wrapper/".$wrapper->wrapperBaseUrl."/edit") ?>" class="btn btn-warning">
	       <span class="glyphicon glyphicon-edit"></span>
	       Edit
	   </a>  

        </div>
	       
	       
	       
	<div class="list-rules">
	     <h4 class="page-title">Products</h4>
	  
	     
	      <table class="table col-70">
		<?php if(!empty($products)):?>
		<?php //print_r($products)?>
		   <?php  //echo "<pre>";print_r($product_options);  echo "</pre>"?>
		<?php foreach($products as $key=>$product):?>
		  <tr>
		    <td colspan="100%"><?php echo $product->productName ?>
			<a href="<?php echo base_url("wrapper/{$wrapper->wrapperBaseUrl}/product/{$product->productBaseUrl}/edit") ?>" class="pull-right">Edit
			    <span class="glyphicon glyphicon-edit"></span>
			</a>
			<span class="pull-right">&nbsp;|&nbsp;</span>
			<a href="" class="pull-right">view options
			    <span class="glyphicon glyphicon-chevron-down"></span>
			</a>
			<span class="pull-right">&nbsp;|&nbsp;</span>
			<a href="<?php echo base_url("add-product-option/wrapper/{$wrapper->wrapperBaseUrl}/product/{$product->productBaseUrl}")  ?>" class="pull-right">Add options
			    <span class="glyphicon glyphicon-plus-sign"></span>
			</a>
			
			<div>
			    
			    <ul> 
				<?php 
				 $options = $product_options[$product->productID];
				 if(!empty($options)):			   
				     foreach ($options as $key => $option):?>
					<li>
					    <?php //print_r($option)?>
					    <?php echo anchor(base_url("edit-product-option/wrapper/{$wrapper->wrapperBaseUrl}/product/{$product->productBaseUrl}/option/".$option->productOptionsID), ucfirst($option->productOptionName) )?>
					</li>

				   <?php endforeach; 			    
				 endif; ?>
			    </ul>
			</div>
		    </td>
		    
		</tr>
		<?php endforeach;?>
		
		<?php else:?>
		<tr>
		    <td>There are no products set. Please add some products</td>
		</tr>
		<?php endif;?>
	    </table>
	     
	</div> 
       
    </div>
        
	</div>
    </div>
    
</div>