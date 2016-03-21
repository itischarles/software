<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo "<pre>";
//print_r($client);
//echo "</pre>";
?>


 
 
<div class="container-fluid">

      <div class="row page-width">
	
	  
	  
	 <div class="col-md-3 sidebar">
            <?php $this->load->view('clients/clients-details-sidebar');?>
        </div>
	
	<div class="col-md-9  bg-white">
	 <div class="content">
	       <h3 class="page-title">Client: <?php echo $client->titleName." ".$client->clientFname." ".$client->clientLname ?> </h3>
	      
	       <table class="table table-responsive col-70 table-striped">
		
	     
	       <tr>
		  <th>Title</th>
		  <td><?php echo $client->titleName?> </td>
	      </tr>
	       <tr>
		  <th>First Name</th>
		  <td><?php    echo ucwords($client->clientFname) ?></td>
	      </tr>
	       <tr>
		  <th>Last Name</th>
		  <td><?php    echo ucwords($client->clientLname) ?></td>
	      </tr>
	        <tr>
		  <th>Middle Name</th>
		  <td><?php    echo $client->clientMidName ?></td>
	      </tr>
	       <tr>
		  <th>Other Names</th>
		  <td><?php    echo $client->clientOtherNames ?></td>
	      </tr>
	      <tr>
		  <th>Date of Birth</th>
		  <td><?php    echo changeDateFormat($client->clientDOB) ?></td>
	      </tr>
	      <tr>
		  <th>Retirement Age</th>
		  <td><?php    echo $client->clientRetirementAge ?></td>
	      </tr>
	       <tr>
		  <th>Time to Retirement</th>
		  <td><?php    echo getActualRetirementDate($client->clientDOB,$client->clientRetirementAge) ?></td>
	      </tr>
	       <tr>
		  <th>Gender</th>
		  <td><?php    echo $client->clientGender ?></td>
	      </tr>
	       <tr>
		  <th>Marital Status</th>
		  <td><?php    echo $marital_status->maritalStatusName ?></td>
	      </tr>
	       <tr>
		  <th>Address Line 1</th>
		  <td><?php    echo $client->clientAddressLine1 ?></td>
	      </tr>
	       <tr>
		  <th>Address Line 2</th>
		  <td><?php    echo $client->clientAddressLine2 ?></td>
	      </tr>
	       <tr>
		  <th>Address Line 3</th>
		  <td><?php    echo $client->clientAddressLine3 ?></td>
	      </tr>
	      
	       <tr>
		  <th>Town/City</th>
		  <td><?php    echo $client->clientCity ?></td>
	      </tr>
	       <tr>
		  <th>County/Region</th>
		  <td><?php    echo $client->clientCounty ?></td>
	      </tr>
	       <tr>
		  <th>Postcode</th>
		  <td><?php    echo $client->clientPostcode ?></td>
	      </tr>
	       <tr>
		  <th>Country</th>
		  <td><?php    echo strtoupper($client->countryAlpha2) ?></td>
	      </tr>
	      
	       <tr>
		  <th>Email</th>
		  <td><?php    echo $client->clientEmail ?></td>
	      </tr>
	       <tr>
		  <th>Telephone</th>
		  <td><?php    echo $client->clientTelephone ?></td>
	      </tr>
	      
	       <tr>
		  <th>Mobile</th>
		  <td><?php    echo $client->clientMobile ?></td>
	      </tr>
	      
	       <tr>
		  <th>Member since:</th>
		  <td><?php    echo changeDateFormat($client->clientDateCreated, 'd-m-Y', true) ?></td>
	      </tr>
	    
	  </table>
	
	
      
       
    </div>
        
	</div>
    </div>
    
</div>