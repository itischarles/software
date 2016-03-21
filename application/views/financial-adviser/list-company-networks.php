<?php

$network_ref  = ($this->input->get('network_ref') ? $this->input->get('network_ref') : '');
$network_name  = ($this->input->get('network_name') ? $this->input->get('network_name') : '');
    
?>


 
 
<div class="container-fluid ">

    <div class="row  page-width ">

       <div class="col-md-3 sidebar">
	  <?php $this->load->view('financial-adviser/fa-sidebar');?>
      </div>

      <div class="col-md-9  bg-white">
       <div class="content">

	<h3 class="page-title">Financial Adviser Companies</h3>
	
	
	   <div class="form_filter">
	    
	    <?php $formOptions = array('method'=>'get','class'=>'form-reg form-inline search-form')?>
	    <?php echo form_open(base_url('financial-adviser/networks'),$formOptions)?>
	    
	 
	   
	    <div class="form-group form-padding-right-4">
		<label for="network_name"> Name</label>	
		<input type="text" name="network_name" value="<?php echo $network_name ?>"/>
	    </div>
	     <div class="form-group form-padding-right-4">
		<label for="network_ref"> Network Ref.</label>	
		<input type="text" name="network_ref"  value="<?php echo $network_ref ?>" />
	    </div>
	    
	    <div class="form-group form-padding-right-4">
		<button class="btn btn-primary-2">
		    Search <span class="glyphicon glyphicon-search"></span>
		</button>
	
	    </div>
	    <?php echo form_close();?>
	</div>
	
	
	    <table class="table table-responsive overview-table isSortable" id="csv_downloadable" data-tableName="csv_downloadable2">
            
            <thead>
                <tr>
		  
                    <th>Company Ref</th>
                    <th>Company Name</th>		    
                    

                </tr>
            </thead>
	    <tfoot>
                <tr>
		   <th>Company Ref</th>
                    <th>Company Name</th>

                </tr>
            </tfoot>
            
            <tbody>
               <?php if(!empty($adviserCompanyNetworks)): ?>
                 <?php foreach($adviserCompanyNetworks as $key=>$facNet):?>
                <?php //print_r($facNet)?>
            
                <tr>
		   
                   
		    <td class="">  <?php echo $facNet->adviserCompanyNetworkReference ?> </td>
                    <td class="">  
			<?php echo anchor(base_url('financial-adviser/network/'.$facNet->adviserCompanyNetworkBaseUrl), $facNet->adviserCompanyNetworkName )?> 
		    
		    </td>

                </tr>
                 <?php endforeach;?>
                
		<?php else:?>
		<tr>
		    <td colspan="100%"></td>
		</tr>
                <?php endif;?>
            </tbody>
            
	    </table>
       
	    
	    <div>
		<?php 	
		if(isset($this->pagination)):
		 
		    echo "<span class='pagination_total_rec'>".
			//$this->pagination->total_rows.
		    show_pagination_text($this->pagination->cur_page, $this->pagination->per_page, 3)    .                           
		        "</span> &nbsp;&nbsp;&nbsp;&nbsp;";
		    echo $this->pagination->create_links();  
		endif; 		    
			?>	
	    </div>
	

       </div>

      </div>
    </div>
    
</div>