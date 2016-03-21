<?php

  
$user_ref  = ($this->input->get('user_ref') ? $this->input->get('user_ref') : '');
$names  = ($this->input->get('names') ? $this->input->get('names') : '');
     
	 
?>


 
 
<div class="container-fluid">

    <div class="row page-width">

       <div class="col-md-3 sidebar">
	   <?php $this->load->view('users/users-sidebar');?>
      </div>

      <div class="col-md-9  bg-white">
       <div class="content">

	<h3 class="page-title">Users</h3>
	
	
	   <div class="form_filter">
	    
	    <?php $formOptions = array('method'=>'get','class'=>'form-reg form-inline')?>
	    <?php echo form_open(base_url('users'),$formOptions)?>
	    
	
	   
	    <div class="form-group form-padding-right-4">
		<label for="names">Names</label>	
		<input type="text" name="names" value="<?php echo $names ?>"/>
	    </div>
	     <div class="form-group form-padding-right-4">
		<label for="user_ref"> User's Ref</label>	
		<input type="text" name="user_ref"  value="<?php echo $user_ref ?>" />
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
                    <th>Full Names</th>		    
                                    
                    <th>Status</th>

                </tr>
            </thead>
	    <tfoot>
                <tr>
		  
                    <th> Ref</th>
                    <th>Full Names</th>		    
                                    
                    <th>Status</th>

                </tr>
            </tfoot>
            
            <tbody>
               <?php if(!empty($users)): ?>
                 <?php foreach($users as $key=>$user):?>
                <?php //print_r($user)?>
            
                <tr>
		    <td><?php echo $user->userID ?></td>
		    <td>
			<?php echo anchor(base_url('user/'.$user->userBaseUrl ),$user->userFirstName." ".$user->userLastName) ?>
		    </td>
		    <td><?php echo $user->userIsActive ?></td>
                   
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