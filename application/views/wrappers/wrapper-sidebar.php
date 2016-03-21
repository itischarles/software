<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//elements-sidebar-add
?>
<div class="sidebar-widget">
    <h3 class="sidebar-widget-title">Add</h3>
    
    <ul class="navbar nav-stacked nav">
	
	<li>
	    <?php echo anchor(base_url('wrappers/wrapper/new'), 'Add New Wrapper')?>
	</li>
	<?php if(isset($show_products_link)):?>
	    <li>
	    <?php echo anchor(base_url('wrapper/'.$wrapper->wrapperBaseUrl.'/product/new'), 'Add Product')?>
	  </li>
	<?php endif;?>
	
	
    </ul>
    
     <h3 class="sidebar-widget-title">Search</h3>
     <ul class="navbar nav-stacked nav">
	
	<li>
	    <?php echo anchor(base_url('wrappers/list-wrappers'), 'Search Wrappers')?>
	</li>
<!--	<li>
	    <?php echo anchor(base_url('financial-adviser/companies'), 'Search Financial Adviser Company')?>
	</li>
	<li>
	    <?php echo anchor(base_url('financial-adviser/networks'), 'Search Adviser Company Network')?>
	</li>
	-->
    </ul>
     
     
     
     <?php if(isset($show_wrapper_rules_link)):?>
	<h3 class="sidebar-widget-title">Account/Wrapper Rules</h3>
	<ul class="navbar nav-stacked nav">

	   <li>
	       <?php echo anchor(base_url("wrapper/".$wrapper->wrapperBaseUrl."/list-rules"), 'List Rules')?>
	   </li>
	 
       </ul>
     
     <?php endif;?>
</div>