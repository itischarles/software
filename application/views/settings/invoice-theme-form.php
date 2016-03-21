
<div class="container-fluid ">
<?php //echo $settings->setting_use_invoice_logo_or_header ?>

    <div class="page-width row">
        
        <?php echo form_open('', array('class'=>"reg-form"))?>
        <h4>Please choose how images/company information is displayed on the invoice</h4>
        
        <p class="form-group"><span class="red-notice">The fields marked * are required</span></p>
        <div>
           
              <span><?php echo form_error('setting_use_invoice_logo_or_header') ?></span>
        </div>
         <div class="form-group">
            <?php echo form_label('Use Invoice Logo Image', 'invoice_logo ') ?>
             <?php $selected = ((!empty($settings) &&($settings->setting_use_invoice_logo_or_header) == "invoice_logo")? "checked='checked'": '' )?>
             <input type="radio" name="setting_use_invoice_logo_or_header" id="invoice_logo" <?php echo $selected ?>/>                     
           
        </div>
       
         <div class="form-group">
            <?php echo form_label('Use Invoice Header Image', 'invoice_header') ?>
             <?php $selected = ((!empty($settings) &&($settings->setting_use_invoice_logo_or_header) == "invoice_header")? "checked='checked'": '' )?>
             
             <input type="radio" name="setting_use_invoice_logo_or_header"  value="invoice_header" id="invoice_header" <?php echo $selected ?>/>   
           
            
        </div>
       
    
    
       
        
        <div class="form-group ">
            
            <?php 
                
                    echo form_submit('save_invoice_theme', "Save Changes", 'class="btn btn-primary"');
                 
             ?>
        </div>
        
        <?php echo form_close()?>
       
        <br/>
    </div>
    
  
</div>