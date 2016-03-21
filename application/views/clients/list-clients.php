<?php

  
 $client_name  = ($this->input->get('client_name') ? $this->input->get('client_name') : '');
 $client_ref  = ($this->input->get('client_ref') ? $this->input->get('client_ref') : '');
 $postcode  = ($this->input->get('postcode') ? $this->input->get('postcode') : '');
 $client_ni  = ($this->input->get('client_ni') ? $this->input->get('client_ni') : '');
     
?>


 
 
<div class="container-fluid ">

    <div class="row page-width">

       <div class="col-md-3 sidebar">
	  <?php $this->load->view('clients/clients-sidebar');?>
      </div>

      <div class="col-md-9  bg-white">
       <div class="content">

	<h3 class="page-title">Clients / Individual Members</h3>
	
	
	   <div class="form_filter">
	    
	    <?php $formOptions = array('method'=>'get','class'=>'form-reg form-inline search-form')?>
	    <?php echo form_open(base_url('clients'),$formOptions)?>
	    
	 
	   
	    <div class="form-group form-padding-right-4">
		<label for="client_name"> Name</label>	
		<input type="text" name="client_name" value="<?php echo $client_name ?>"/>
	    </div>
	     <div class="form-group form-padding-right-4">
		<label for="client_ref"> Client's Ref</label>	
		<input type="text" name="client_ref"  value="<?php echo $client_ref ?>" />
	    </div>
	    <div class="form-group form-padding-right-4">
		<label for="client_ni"> Client's NI</label>	
		<input type="text" name="client_ni"  value="<?php echo $client_ni ?>" />
	    </div>
	    <div class="form-group form-padding-right-4">
		<label for="postcode">Postcode</label>	
		<input type="text" name="postcode"  value="<?php echo $postcode ?>" />
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
		   <th>Client Ref</th>
                  <th>Full Names</th>		    
                  <th>Postcode</th>
		  <th>National Insurance No.</th>
		  <th>Status</th>

                </tr>
            </thead>
	    <tfoot>
                <tr>
		  <th>Client Ref</th>
                  <th>Full Names</th>		    
                  <th>Postcode</th>
		  <th>National Insurance No.</th>
		  <th>Status</th>
                </tr>
            </tfoot>
            
            <tbody>
               <?php if(!empty($clients)): ?>
                 <?php foreach($clients as $key=>$client):?>
                <?php //print_r($invoice)?>
            
                <tr>
		   <td>  <?php echo anchor(base_url("client/{$client->clientBaseUrl}"), $client->clientID);?> </td>
		    <td>  <?php echo anchor(base_url("client/{$client->clientBaseUrl}"), $client->clientFname." ".$client->clientLname);?> </td>
		   
                   <td class="">  <?php echo $client->clientPostcode ?> </td>
		   <td class="">  <?php echo $client->clientNI ?> </td>
                                  
                   <td></td>
                </tr>
                 <?php endforeach;?>
                
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