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
	
	       
	<div class="list-rules">
	     <h3 class="page-title">Products</h3>
	    <table class="table col-70">
		<tr>
		    <td colspan="100%"><?php echo $product->productName ?>
			<a href="<?php echo base_url("wrapper/{$wrapper->wrapperBaseUrl}/product/{$product->productBaseUrl}/edit") ?>" class="pull-right">Edit
			    <span class="glyphicon glyphicon-edit"></span>
			</a>
		    </td>
		    
		</tr>
	    </table>	    
	</div>
	       
	 <div class="list-rules">
	     <h4 class="page-title">Products Options</h4>
	    <table class="table col-70 none">
		<tr>
		    <td colspan="100%"><?php echo $product->productName ?>
			<a href="<?php echo base_url("wrapper/{$wrapper->wrapperBaseUrl}/product/{$product->productBaseUrl}/edit") ?>" class="pull-right">Edit
			    <span class="glyphicon glyphicon-edit"></span>
			</a>
		    </td>
		    
		</tr>
	    </table>	    
	</div>      
      
       
    </div>
        
	</div>
    </div>
    
</div>