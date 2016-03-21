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
	    <?php echo anchor(base_url('search/adviser'), 'Add Financial Adviser')?>
	</li>
	<li>
	    <?php echo anchor(base_url('element/adviser-company/new'), 'Add Financial Adviser Company')?>
	</li>
	<li>
	    <?php echo anchor(base_url('search/users'), 'Add User/Login')?>
	</li>
    </ul>
</div>