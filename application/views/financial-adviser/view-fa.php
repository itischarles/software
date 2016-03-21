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
            <?php $this->load->view('financial-adviser/fa-sidebar');?>
        </div>
	
	<div class="col-md-9  bg-white">
	 <div class="content">
	       <h3 class="page-title">Financial Adviser</h3>
	      
	       <table class="table table-responsive col-70 table-striped">
		<tr>
		  <th>Company Names</th>
		  <td><?php echo $adviser->adviserCompanyName ?>
		  
		  </td>
	      </tr>
	      <tr>
		  <th>Full Names</th>
		  <td><?php echo $adviser->userFirstName." ".$adviser->userLastName ?>
		  
		  </td>
	      </tr>
	       <tr>
		  <th>Address Line 1</th>
		  <td><?php    echo $adviser->userAddressLine1 ?></td>
	      </tr>
	       <tr>
		  <th>Address Line 2</th>
		  <td><?php    echo $adviser->userAddressLine2 ?></td>
	      </tr>
	       <tr>
		  <th>Address Line 3</th>
		  <td><?php    echo $adviser->userAddressLine3 ?></td>
	      </tr>
	      
	       <tr>
		  <th>Town/City</th>
		  <td><?php    echo $adviser->userCity ?></td>
	      </tr>
	       <tr>
		  <th>County/Region</th>
		  <td><?php    echo $adviser->userCounty ?></td>
	      </tr>
	       <tr>
		  <th>Postcode</th>
		  <td><?php    echo $adviser->userPostcode ?></td>
	      </tr>
	      
	       <tr>
		  <th>Email</th>
		  <td><?php    echo $adviser->userEmail ?></td>
	      </tr>
	       <tr>
		  <th>Telephone</th>
		  <td><?php    echo $adviser->userTelephone ?></td>
	      </tr>
	      
	       <tr>
		  <th>Mobile</th>
		  <td><?php    echo $adviser->userMobile ?></td>
	      </tr>
	      
	       <tr>
		  <th>FCA Number</th>
		  <td><?php    echo $adviser->adviserFCAnumber ?></td>
	      </tr>
	       <tr>
		  <th>Bank Name</th>
		  <td><?php    echo $adviser->adviserBankName ?></td>
	      </tr>
	       <tr>
		  <th>Account Number</th>
		  <td><?php    echo $adviser->adviserBankAccount ?></td>
	      </tr>
	       <tr>
		  <th>Sort Code</th>
		  <td><?php    echo $adviser->adviserSortcode ?></td>
	      </tr>
	      
	       <tr>
		  <th>Login/username</th>
		  <td><?php    echo $adviser->userUsername ?></td>
	      </tr>
	      
	  </table>
	
	<div class="text-right col-70">
          
	    <a href="<?php echo base_url("financial-adviser/adviser/".$adviser->userBaseUrl."/edit") ?>" class="btn btn-warning">
	       <span class="glyphicon glyphicon-edit"></span>
	       Edit
	   </a>  

        </div>
      
       
    </div>
        
	</div>
    </div>
    
</div>