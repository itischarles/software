<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//elements-sidebar-add
?>
<div class="sidebar-widget">
    <h3 class="sidebar-widget-title">Add Users/Login</h3>
    
    <ul class="navbar nav-stacked nav">
	
	<li>
	    <?php echo anchor(base_url('user/new'), 'Add User')?>
	</li>
	
	
    </ul>
    
     <h3 class="sidebar-widget-title">Search Users</h3>
     <ul class="navbar nav-stacked nav">
	
	<li>
	    <?php echo anchor(base_url('users'), 'Find Users')?>
	</li>
	
	
    </ul>
</div>