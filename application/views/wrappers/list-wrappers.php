<?php

  
$wrapper_name  = ($this->input->get('wrapper_name') ? $this->input->get('wrapper_name') : '');
$wrapper_ref  = ($this->input->get('wrapper_ref') ? $this->input->get('wrapper_ref') : '');
 
?>


 
 
<div class="container-fluid ">

    <div class="row page-width">

       <div class="col-md-3 sidebar">
	  <?php $this->load->view('wrappers/wrapper-sidebar');?>
      </div>

      <div class="col-md-9  bg-white">
       <div class="content">

	<h3 class="page-title">Wrappers / Account Types</h3>
	
	
	   <div class="form_filter">
	    
	    <?php $formOptions = array('method'=>'get','class'=>'form-reg form-inline search-form')?>
	    <?php echo form_open(base_url('wrappers/list-wrappers'),$formOptions)?>
	    
	 
	   
	    <div class="form-group form-padding-right-4">
		<label for="wrapper_name">  Name</label>	
		<input type="text" name="wrapper_name" value="<?php echo $wrapper_name ?>"/>
	    </div>
	     <div class="form-group form-padding-right-4">
		<label for="wrapper_ref">  Reference</label>	
		<input type="text" name="wrapper_ref"  value="<?php echo $wrapper_ref?>" />
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
		  
                    <th> Ref</th>
                    <th> Name</th>		    
                    

                </tr>
            </thead>
	    <tfoot>
                <tr>
		  <th> Ref</th>
                    <th> Name</th>

                </tr>
            </tfoot>
            
            <tbody>
               <?php if(!empty($wrappers)): ?>
                 <?php foreach($wrappers as $key=>$wrapper):?>
                <?php //print_r($wrapper)?>
            
                <tr>
		   
                   
		    <td class="">  <?php echo $wrapper->wrapperRef ?> </td>
                    <td class="">  
			<?php echo anchor(base_url('wrapper/'.$wrapper->wrapperBaseUrl), $wrapper->wrapperName) ?>
		    
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