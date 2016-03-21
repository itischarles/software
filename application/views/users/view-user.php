<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


 
 
<div class="container-fluid">

      <div class="row page-width">
	
	  
	  
	 <div class="col-md-3 sidebar">
             <?php $this->load->view('users/users-sidebar');?>
        </div>
	
	<div class="col-md-9  bg-white">
	 <div class="content">
	       <h3 class="page-title">User Details</h3>
	      
	       <table class="table table-responsive col-70 table-striped">
		
	      <tr>
		  <th>Full Names</th>
		  <td><?php echo $users->userFirstName." ".$users->userLastName ?>
		  
		  </td>
	      </tr>
	       <tr>
		  <th>Address Line 1</th>
		  <td><?php    echo $users->userAddressLine1 ?></td>
	      </tr>
	       <tr>
		  <th>Address Line 2</th>
		  <td><?php    echo $users->userAddressLine2 ?></td>
	      </tr>
	       <tr>
		  <th>Address Line 3</th>
		  <td><?php    echo $users->userAddressLine3 ?></td>
	      </tr>
	      
	       <tr>
		  <th>Town/City</th>
		  <td><?php    echo $users->userCity ?></td>
	      </tr>
	       <tr>
		  <th>County/Region</th>
		  <td><?php    echo $users->userCounty ?></td>
	      </tr>
	       <tr>
		  <th>Postcode</th>
		  <td><?php    echo $users->userPostcode ?></td>
	      </tr>
	      
	       <tr>
		  <th>Email</th>
		  <td><?php    echo $users->userEmail ?></td>
	      </tr>
	       <tr>
		  <th>Telephone</th>
		  <td><?php    echo $users->userTelephone ?></td>
	      </tr>
	      
	       <tr>
		  <th>Mobile</th>
		  <td><?php    echo $users->userMobile ?></td>
	      </tr>
	      
	      
	      
	       <tr>
		  <th>Login/username</th>
		  <td><?php    echo $users->userUsername ?></td>
	      </tr>
	      
	  </table>
	
	<div class="text-right col-70">
          
	    <a href="<?php echo base_url("user/".$users->userBaseUrl."/edit") ?>" class="btn btn-warning">
	       <span class="glyphicon glyphicon-edit"></span>
	       Edit
	   </a>  

        </div>
      
       
    </div>
        
	</div>
    </div>
    
</div>