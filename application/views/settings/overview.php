

<div class="container-fluid">
  
    <div class="page-width">
    <div class="row settings-page">
        <div class="col-md-3 col-sm-3">
            <h2>My Company</h2>
        </div>

        <div class="col-md-3 col-sm-3">
            <?php echo heading(anchor(base_url('settings/company-details'),'Company Details'), 3) ?>
           
            
            <p> Edit your address details, contact details and other company information.</p>

        </div>
        <div class="col-md-3 col-sm-3">
                <?php echo heading(anchor(base_url('wrapper'),'Wrappers/Account'), 3) ?>
             
              <p>
                Manage Wrappers and Account Names
              </p>
            
        </div>

          <div class="col-md-3 col-sm-3">
                 <?php echo heading(anchor(base_url('users'),'Users'), 3) ?>
<!--              <h3> <a href="#">Users</a></h3>-->
                <p>
                  Add and manage users, passwords and control user access levels.
                </p>
              
        </div>
    </div>
    

    
     <hr/>
    
     <div class="row">
        <div class="col-md-3 col-sm-3">
            <h2>Clients</h2>
        </div>

        <div class="col-md-3 col-sm-3">
           
             <?php echo heading(anchor(base_url('titles/list-titles'),'Titles'), 3) ?>
              
              <p>
                Setup and manage acceptable/possible title names for users
              </p>
            
        </div>
        <div class="col-md-3 col-sm-3">
            <?php echo heading(anchor(base_url('marital-status/list-statuses'),'Marital Status'), 3) ?>
            
              <p>
                Manage marital statuses
              </p>
            
        </div>
	<div class="col-md-3 col-sm-3">
		<?php echo heading(anchor(base_url('employment-types/list-employment-types'),'Employment Types'), 3) ?>

		  <p>
		    Manage Employment types
		  </p>

        </div>
    </div>
    
    <hr/>
    
     <div class="row">
        <div class="col-md-3 col-sm-3">
            <h2>Accounts</h2>
        </div>

        <div class="col-md-3 col-sm-3">
           
             <?php echo heading(anchor(base_url('wrappers/list-wrappers'),'Wrappers/Accounts'), 3) ?>
              
              <p>
                Manage System-wide accounts and wrappers
              </p>
            
        </div>
        <div class="col-md-3 col-sm-3">
            
            
        </div>

          <div class="col-md-3 col-sm-3">
            
              
        </div>
    </div>
    
    <hr/>
    
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <h2>Setup</h2>
        </div>

        <div class="col-md-3 col-sm-3">
           
             <?php echo heading(anchor(base_url('config/system_initial_config/install'),'Inital System Setup'), 3) ?>
              
              <p>
                Initial system setup is a one-off click to configure the system for first 'proper'
		use. subsequent clicks are ignored !!
              </p>
            
        </div>
        <div class="col-md-3 col-sm-3">
            
        </div>

          <div class="col-md-3 col-sm-3">
           
              
        </div>
    </div>

    
    </div><!--end page--width-->
    
</div>