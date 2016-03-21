<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="sidebar-widget">
    <h3 class="sidebar-widget-title">Find</h3>
    
    <ul class="navbar nav-stacked nav">
	<li>
	    <?php echo anchor(base_url('search/client'), 'Find Client')?>
	</li>
	<li>
	    <?php echo anchor(base_url('search/adviser'), 'Find Financial Adviser')?>
	</li>
	<li>
	    <?php echo anchor(base_url('search/adviser-company'), 'Find Financial Adviser Company')?>
	</li>
	<li>
	    <?php echo anchor(base_url('search/users'), 'Find User/Login')?>
	</li>
    </ul>
</div>
