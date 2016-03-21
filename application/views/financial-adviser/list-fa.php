<?php

  
$adviser_ref  = ($this->input->get('adviser_ref') ? $this->input->get('adviser_ref') : '');
$adviser_name  = ($this->input->get('adviser_name') ? $this->input->get('adviser_name') : '');
    
?>


 
 
<div class="container-fluid ">

    <div class="row  page-width">

       <div class="col-md-3 sidebar">
	  <?php $this->load->view('financial-adviser/fa-sidebar');?>
      </div>

      <div class="col-md-9  bg-white">
       <div class="content">

	<h3 class="page-title">Financial Advisers</h3>
	
	
	   <div class="form_filter">
	    
	    <?php $formOptions = array('method'=>'get','class'=>'form-reg form-inline')?>
	    <?php echo form_open(base_url('financial-advisers'),$formOptions)?>
	    
	 
	   
	    <div class="form-group form-padding-right-4">
		<label for="adviser_name"> Adviser's Name</label>	
		<input type="text" name="adviser_name" value="<?php echo $adviser_name ?>"/>
	    </div>
	     <div class="form-group form-padding-right-4">
		<label for="adviser_ref"> Adviser's Ref</label>	
		<input type="text" name="adviser_ref"  value="<?php echo $adviser_ref ?>" />
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
		  
                    <th>Adviser Ref</th>
                    <th>Full Names</th>		    
                    <th>Company</th>
                    <th>FCA Number</th>                  
                    <th>Status</th>

                </tr>
            </thead>
	    <tfoot>
                <tr>
		  
                    <th>Adviser Ref</th>
                    <th>Full Names</th>		    
                    <th>Company</th>
                    <th>FCA Number</th>                  
                    <th>Status</th>

                </tr>
            </tfoot>
            
            <tbody>
               <?php if(!empty($advisers)): ?>
                 <?php foreach($advisers as $key=>$fa):?>
                <?php //print_r($invoice)?>
            
                <tr>
		   
                    <td class="date"><?php echo changeDateFormat($invoice->invoice_date,"d M Y") ?></td>
                    <td class="date ">
                        <?php echo changeDateFormat($invoice->invoice_payment_due_date,"d M Y") ?>
                       
                    </td>
                  
                    <td>  <?php echo anchor(base_url("invoice/{$invoice->invoiceID}/client/".$invoice->clientUrl), "invoice ".prefixZeroToNumbers($invoice->invoiceID), '');?> </td>
                    <td>
                         <?php echo anchor(base_url('client/view/'.$invoice->clientUrl),
                                   $invoice->client_title ." ".$invoice->client_fname." ". $invoice->client_lname
                                 );?>
                        
                    </td>
		    <td class="num">  <?php echo number_format($invoice->invoice_ground_total,2) ?> </td>
                    <td>
			<?php //echo $invoice->status_name ?>
			
			<?php echo (writeInvoiceStatus($invoice->status_statusID, $invoice->invoice_payment_due_date, $invoice->invoice_date_completed)) ?>
			
		    </td>

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