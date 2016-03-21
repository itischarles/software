<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


 
 
<div class="container-fluid">

      <div class="row element-view">
	
	  
	  
	 <div class="col-md-3 sidebar">
            <?php $this->load->view('financial-adviser/fa-sidebar');?>
        </div>
	
	<div class="col-md-9  bg-white">
	 <div class="content">
	       <h3 class="page-title">Financial Adviser Company</h3>
	       <table class="table table-responsive col-70 table-striped">
	      <tr>
		  <th>Company Name</th>
		  <td><?php    echo $adviserCompany->adviserCompanyName ?></td>
	      </tr>
	       <tr>
		  <th>Address Line 1</th>
		  <td><?php    echo $adviserCompany->adviserCompanyAddress1 ?></td>
	      </tr>
	       <tr>
		  <th>Address Line 2</th>
		  <td><?php    echo $adviserCompany->adviserCompanyAddress2 ?></td>
	      </tr>
	       <tr>
		  <th>Address Line 3</th>
		  <td><?php    echo $adviserCompany->adviserCompanyAddress3 ?></td>
	      </tr>
	      
	       <tr>
		  <th>Town/City</th>
		  <td><?php    echo $adviserCompany->adviserCompanyCity ?></td>
	      </tr>
	       <tr>
		  <th>County/Region</th>
		  <td><?php    echo $adviserCompany->adviserCompanyCounty ?></td>
	      </tr>
	       <tr>
		  <th>Postcode</th>
		  <td><?php    echo $adviserCompany->adviserCompanyPostcode ?></td>
	      </tr>
	      
	       <tr>
		  <th>Email</th>
		  <td><?php    echo $adviserCompany->adviserCompanyEmail ?></td>
	      </tr>
	       <tr>
		  <th>Telephone</th>
		  <td><?php    echo $adviserCompany->adviserCompanyTel ?></td>
	      </tr>
	  </table>
	
	<div class="text-right col-70">
          
	    <a href="<?php echo base_url("financial-adviser/company/".$adviserCompany->adviserCompanyBaseUrl."/edit") ?>" class="btn btn-warning">
	       <span class="glyphicon glyphicon-edit"></span>
	       Edit
	   </a>  

        </div>
      
       
    </div>
        
	</div>
    </div>
    
</div>