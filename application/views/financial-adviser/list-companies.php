<?php

  
$company_ref  = ($this->input->get('company_ref') ? $this->input->get('company_ref') : '');
$company_name  = ($this->input->get('company_name') ? $this->input->get('company_name') : '');
    
?>


 
 
<div class="container-fluid">

    <div class="row  page-width">

       <div class="col-md-3 sidebar">
	  <?php $this->load->view('financial-adviser/fa-sidebar');?>
      </div>

      <div class="col-md-9  bg-white">
       <div class="content">

	<h3 class="page-title">Financial Adviser Companies</h3>
	
	
	   <div class="form_filter">
	    
	    <?php $formOptions = array('method'=>'get','class'=>'form-reg form-inline')?>
	    <?php echo form_open(base_url('fa-companies'),$formOptions)?>
	    
	 
	   
	    <div class="form-group form-padding-right-4">
		<label for="company_name"> Company Name</label>	
		<input type="text" name="company_name" value="<?php echo $company_name ?>"/>
	    </div>
	     <div class="form-group form-padding-right-4">
		<label for="company_ref"> Company Ref</label>	
		<input type="text" name="company_ref"  value="<?php echo $company_ref ?>" />
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
               <?php if(!empty($fa_companies)): ?>
                 <?php foreach($fa_companies as $key=>$fac):?>
                <?php //print_r($fac)?>
            
                <tr>
		   
                   
		    <td class="">  <?php echo $fac->adviserCompanyID ?> </td>
                    <td class="">  <?php echo $fac->adviserCompanyName ?> </td>

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