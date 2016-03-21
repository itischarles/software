<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//elements-sidebar-add
?>
<div class="sidebar-widget">
    <h3 class="sidebar-widget-title">Accounts</h3>
    
    <?php if(!empty($wrappers)): ?>
	  <ul class="navbar nav-stacked nav">
	<?php foreach($wrappers as $key=>$wrapper):?>
	      <?php		//print_r($wrapper)?>
	    <li>
		<?php echo anchor(base_url("client/{$client->clientBaseUrl}/account/".$wrapper->wrapperBaseUrl."/new-application"), 'Apply for '.$wrapper->wrapperName)?>
	    </li>
	<?php endforeach;?>
	      </ul>
    <?php endif;?>
	   
	
    
     <h3 class="sidebar-widget-title">Existing Accounts</h3>
     <ul class="navbar nav-stacked nav">
	
	<li>
	    <?php //echo anchor(base_url('clients'), 'prouct 1')?>
	</li>
	
    </ul>
     
     <h3 class="sidebar-widget-title">Manage Client</h3>
     <ul class="navbar nav-stacked nav">
	
	<li>
	   <a href="<?php echo base_url("client/".$client->clientBaseUrl."/edit") ?>" class="">
	       <span class="glyphicon glyphicon-edit"></span>
	       Edit
	   </a>  
	</li>
	
    </ul>
</div>