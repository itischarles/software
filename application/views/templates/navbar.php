<div class="logo-nav-wrapper">
<nav class="navbar navbar-default ">
    <div class="page-width">
        <div class="container-fluid"> 
          
            <ul class="nav navbar-nav col-100 navbar-brand-div">  
                <li class="pull-left">
                     <a href="<?php echo base_url('dashboard') ?>" class="navbar-brand">			
			 <img src="<?php echo base_url('images/logo-blank-40.jpg')?>" alt="Intelligent Money" class=""/>
			 <span class="logo-name1">Company</span><span class="logo-name2"> Name</span>
		    </a>
                </li>
                <li class="pull-right">	
		 
		    <a href="<?php echo base_url('user/'.$this->session->userdata('userBaseUrl')) ?>">
			<span class="glyphicon glyphicon-user"></span>
			My Account
		    </a>
		  
		</li>
                <li class="pull-right">
		     <a href="<?php echo base_url('auth/logout') ?>">
			<span class="glyphicon glyphicon-off"></span>
			Logout
		    </a>
		   
		</li>
            </ul>
              
        
        </div><!--/.container-fluid -->
	
    </div><!-- end page width-->
</nav>

</div>



<nav class="navbar navbar-default bg-gray-light">
    <div class="container-fluid">
    <div class="page-width">
      <div class="navbar-header">
	<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
	  <span class="sr-only">Toggle navigation</span>
	  <span class="icon-bar"></span>
	  <span class="icon-bar"></span>
	  <span class="icon-bar"></span>
	</button>

      </div>
      <div class="navbar-collapse collapse" id="navbar">
	<ul class="nav navbar-nav">
	  <li class="none <?php echo (isset($link_title) &&($link_title == 'dashboard')? 'active': '') ?>">
	      <a href="<?php echo base_url('dashboard') ?>">Dashboard</a>
	  </li>
<!--              <li class="<?php echo (isset($link_title) &&($link_title == 'find')? 'active': '') ?>">
	      <a href="<?php echo base_url('search/client') ?>">Find</a>
	  </li>
	  <li class="<?php echo (isset($link_title) &&($link_title == 'users')? 'active': '') ?>">
	      <a href="<?php echo base_url('users') ?>">Users</a>
	  </li>
-->
	  <li class="<?php echo (isset($link_title) &&($link_title == 'fa')? 'active': '') ?>">
		    <?php echo anchor(base_url('financial-adviser/advisers'), 'Financial Advisers')?>
	   </li>


	   <li class="<?php echo (isset($link_title) &&($link_title == 'reporting')? 'active': '') ?>">
		    <?php echo anchor(base_url('reporting'), 'Reporting')?>
	   </li>

	

	   <li class="<?php echo (isset($link_title) &&($link_title == 'jobs')? 'active': '') ?>">
		    <?php echo anchor(base_url('Jobs'), 'Jobs')?>
	   </li>

	    <li class="<?php echo (isset($link_title) &&($link_title == 'workflow')? 'active': '') ?>">
		    <?php echo anchor(base_url('clients'), 'Clients')?>
	   </li>
	   <li class="<?php echo (isset($link_title) &&($link_title == 'setting')? 'active': '') ?>">
		    <?php echo anchor(base_url('system-setting'), 'System Settings')?>
	   </li>



	</ul>


      </div><!--/.nav-collapse -->
    </div><!-- end page-width-->
    </div><!--/.container-fluid -->
</nav>
    

 
<div class="container-fluid">
    <div class="page-width">
       <?php $this->load->view('templates/flash_message');?>
    </div>
</div>

<!--
<div class="container-fluid">

    <ul class="breadcrumb">

    </ul>

    
</div>
-->
