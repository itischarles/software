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
	 
	<div>
	    <p> 
		<a href="<?php echo base_url('wrapper/'.$wrapper->wrapperBaseUrl) ?>"  class="btn btn-primary-2">
		    Back to Wrapper
		</a>
		<a href="#" onclick="toggleElement('addNewRule')" class="btn btn-primary-2">
		    Add New Rule
		</a>
<!--		<button onclick="toggleElement('addNewRule')"></button>-->
	    </p>
	    <div style="<?php if($this->input->post('add_rule') ? '' : 'display: none')?> display: none" id="addNewRule">
	    <?php $this->load->view('wrappers/form-wrapper-rules');?>
	    </div>
	</div>
	       
	<div class="list-rules">
	     <h3 class="page-title">Rules</h3>
	    <table class="table">
		<?php if(!empty($wrapper_rules)):?>
		<?php //print_r($wrapper_rules)?>
		<?php foreach($wrapper_rules as $key=>$val):?>
		<tr>
		    <td colspan="100%"><?php echo $val->wrapperRuleName ?></td>
		    
		</tr>
		<tr>
		    <td colspan="100%"><?php echo $val->wrapperRuleDesc ?></td>
		</tr>
		<?php endforeach;?>
		
		<?php else:?>
		<tr>
		    <td>There are no rules set. Please add some rules</td>
		</tr>
		<?php endif;?>
	    </table>
	    
	</div>
      
       
    </div>
        
	</div>
    </div>
    
</div>