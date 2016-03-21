     <!-- lets display the flash data if is set-->
     <!-- types are 'flash_error' and  'flash_success'-->
     <?php if($this->session->flashdata('message')):?>
     
     <?php 
     
     if($this->session->flashdata('type') == "flash_error"):
         $class = "alert-danger";
     elseif($this->session->flashdata('type') == "flash_success"):
         $class = "alert-success";
     else:
         $class = "alert-info";
     endif;
         
         
         ?>
     
     <div class="<?php echo $class ?> alert" id="flash_message">
	 <div class="col-70 auto-margin">
	     <?php  echo $this->session->flashdata('message') ;?>
                 <button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">
                    &times;
                 </button>
	 </div>
                
        </div>
     <?php endif; ?>

     