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
	    <?php echo anchor(base_url('financial-adviser/adviser/new'), 'Add Financial Adviser')?>
	</li>
	<li>
	    <?php echo anchor(base_url('financial-adviser/company/new'), 'Add FA Company')?>
	</li>
	<li>
	    <?php echo anchor(base_url('financial-adviser/network/new'), 'Add FA Company Network')?>
	</li>
	
    </ul>
    
     <h3 class="sidebar-widget-title">Search</h3>
     <ul class="navbar nav-stacked nav">
	
	<li>
	    <?php echo anchor(base_url('financial-adviser/advisers'), 'Search Financial Adviser')?>
	</li>
	<li>
	    <?php echo anchor(base_url('financial-adviser/companies'), 'Search FA Company')?>
	</li>
	<li>
	    <?php echo anchor(base_url('financial-adviser/networks'), 'Search FA Company Network')?>
	</li>
	
    </ul>
</div>