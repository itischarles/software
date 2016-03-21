
<div class="container-fluid">

    <div class="page-width">

    <div class="row">
        
        <div class="col-md-6 col-sm-6"> <!-- start lft column-->
            
            <div class="well  well-sm">
                <h5>Replace your Site logo</h5>

                <p>The Logo appearing on this system</p>
                
                <?php if(isset($site_logo_upload_error) &&(!empty($site_logo_upload_error))):?>
                <div class="alert alert-danger">
                    <?php  echo "<p>".$site_logo_upload_error."</p>";?>
                </div>                   
               <?php  endif;?>
                
                <div>
                    <?php echo form_open_multipart('', array('class'=>"reg-form"))?>
                        <div class="form-group">
                          
                            <input type="file" name="site_logo" id="site_logo"/>
                            <input type="hidden" name="site_logo_ref" id="" value="1"/>
                            <span><?php echo form_error('site_logo') ?></span>

                        </div>  
                        
                    <div class="form-group">
                        <p style="font-size: 11px">Make it large  either PNG, GIF or JPG format</p>
                    </div>
                        
                        <div class="form-group ">
                            <?php
                              echo form_submit('upload_site_logo', "Upload", 'class="btn btn-primary"');

                             ?>
                        </div>
                    <?php echo form_close()?>
                </div>
                
                
            </div>
            
            
            <div class="">
                <?php if(!empty($settings->setting_company_logo_path)):?>                    
                    <?php   echo img(base_url($settings->setting_company_logo_path));?>
                    
                    <?php echo anchor(base_url('settings/delete-image/type/site-logo'), "Delete Image")?>
                <?php endif;?>
      
             </div>
            
        </div> <!-- end left column-->
        
        
        <div class="col-md-6 col-sm-6"> <!-- start lft column-->
             <div class="well  well-sm">
                <h5>Replace your Invoices logo</h5>

                <p>The image appearing on your Invoices</p>
                
                <?php if(isset($invoice_logo_upload_error) &&(!empty($invoice_logo_upload_error))):?>
                <div class="alert alert-danger">
                    <?php  echo "<p>".$invoice_logo_upload_error."</p>";?>
                </div>                   
               <?php  endif;?>
                
                
                <div>
                    <?php echo form_open_multipart('', array('class'=>"reg-form"))?>
                        <div class="form-group">
                          
                            <input type="file" name="invoice_logo" id="invoice_logo"/>
                             <input type="hidden" name="invoice_logo_ref" id="" value="1"/>
                            <span><?php echo form_error('invoice_logo') ?></span>

                        </div>  
                        
                    <div class="form-group">
                        <p style="font-size: 11px">Make it large  either PNG, GIF or JPG format</p>
                    </div>
                        
                        <div class="form-group ">
                            <?php
                              echo form_submit('upload_invoice_logo', "Upload", 'class="btn btn-primary"');

                             ?>
                        </div>
                    <?php echo form_close()?>
                </div>
            </div>
            
            <div class="">
                <?php if(!empty($settings->setting_company_invoice_logo_path)):?>                    
                    <?php   echo img(base_url($settings->setting_company_invoice_logo_path));?>
                    
                    <?php echo anchor(base_url('settings/delete-image/type/invoice-logo'), "Delete Image")?>
                <?php endif;?>
      
             </div>
           
        </div> <!-- end left column-->
        
        
    </div>
    
  
    <div class="row">
        
        <div class="col-md-6 col-sm-6"> <!-- start lft column-->
             <div class="well  well-sm">
                <h5>Replace the entire header of your Invoices</h5>

                <p>The image appearing on header of your Invoices</p>
                
                <?php if(isset($invoice_header_upload_error) &&(!empty($invoice_header_upload_error))):?>
                <div class="alert alert-danger">
                    <?php  echo "<p>".$invoice_header_upload_error."</p>";?>
                </div>                   
               <?php  endif;?>
                <div>
                    <?php echo form_open_multipart('', array('class'=>"reg-form"))?>
                        <div class="form-group">
                          
                              <input type="file" name="invoice_header" id="invoice_header"/>
                               <input type="hidden" name="invoice_header_ref" id="" value="1"/>
                            <span><?php echo form_error('invoice_header') ?></span>

                        </div>  
                        
                    <div class="form-group">
                        <p style="font-size: 11px">Make it large  either PNG, GIF or JPG format</p>
                    </div>
                        
                        <div class="form-group ">
                            <?php
                              echo form_submit('upload_invoice_header', "Upload", 'class="btn btn-primary"');

                             ?>
                        </div>
                    <?php echo form_close()?>
                </div>
            </div>
          
             <div class="">
                <?php if(!empty($settings->setting_company_invoice_header_path)):?>                    
                    <?php   echo img(base_url($settings->setting_company_invoice_header_path));?>
                    
                    <?php echo anchor(base_url('settings/delete-image/type/invoice-header'), "Delete Image")?>
                <?php endif;?>
      
             </div>
        </div> <!-- end left column-->
        
        
        <div class="col-md-6 col-sm-6"> <!-- start lft column-->
            
            <div class="well  well-sm">
                <h5>Replace the entire footer of your Invoices</h5>

                <p>The image appearing on footer of your Invoices</p>
                
                 <?php if(isset($invoice_footer_upload_error) &&(!empty($invoice_footer_upload_error))):?>
                <div class="alert alert-danger">
                    <?php  echo "<p>".$invoice_footer_upload_error."</p>";?>
                </div>                   
               <?php  endif;?>
                <div>
                    <?php echo form_open_multipart('', array('class'=>"reg-form"))?>
                        <div class="form-group">
                          
                              <input type="file" name="invoice_footer" id="invoice_footer"/>
                               <input type="hidden" name="invoice_header_ref" id="" value="1"/>
                            <span><?php echo form_error('invoice_footer') ?></span>

                        </div>  
                        
                    <div class="form-group">
                        <p style="font-size: 11px">Make it large  either PNG, GIF or JPG format</p>
                    </div>
                        
                        <div class="form-group ">
                            <?php
                              echo form_submit('upload_invoice_footer', "Upload", 'class="btn btn-primary"');

                             ?>
                        </div>
                    <?php echo form_close()?>
                </div>
            </div>
            
             <div class="">
                <?php if(!empty($settings->setting_company_invoice_footer_path)):?>                    
                    <?php   echo img(base_url($settings->setting_company_invoice_footer_path));?>
                    
                    <?php echo anchor(base_url('settings/delete-image/type/invoice-footer'), "Delete Image")?>
                <?php endif;?>
      
             </div>
        </div> <!-- end left column-->
        
        
    </div>
	
    </div><!-- end page-width-->
</div>