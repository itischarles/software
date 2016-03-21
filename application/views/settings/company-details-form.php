
<div class="container-fluid">


    <div class="row page-width">
        
        <?php echo form_open('', array('class'=>"reg-form"))?>
        <h3>About  your Company</h3>
        
        <p class="form-group"><span class="red-notice">The fields marked * are required</span></p>
        
         <div class="form-group">
            <?php echo form_label('Company Name', 'setting_company_name') ?>
             
            <?php
              $data = array(
                'name'        => 'setting_company_name',
                'id'          => 'setting_company_name',
                'value'       => set_value('setting_company_name', (!empty($settings)) ? $settings->setting_company_name : ''),
                'class'       => 'field',
                'required'  =>'required'
               );
            
            echo form_input($data);
            ?>
            <span class="input-is-required">*</span>
            <span class="alert-danger"><?php echo form_error('setting_company_name') ?></span>
            
        </div>
       
         
         
        
        
         <div class="form-group">
            <?php echo form_label('Company Address 1', 'setting_company_address_1') ?>
            <?php
              $data = array(
                'name'        => 'setting_company_address_1',
                'id'          => 'setting_company_address_1',
                'value'       => set_value('setting_company_address_1', (!empty($settings)) ? $settings->setting_company_address_1 : ''),
                'class'       => 'field',
                  'required'  =>'required'
               );
            
            echo form_input($data);
            ?>
             <span class="input-is-required">*</span>
            <span class="alert-danger"><?php echo form_error('setting_company_address_1') ?></span>
            
        </div>
        
        
        <div class="form-group">
            <?php echo form_label('', 'setting_company_address_2') ?>
            <?php
              $data = array(
                'name'        => 'setting_company_address_2',
                'id'          => 'setting_company_address_2',
                'value'       => set_value('setting_company_address_2', (!empty($settings)) ? $settings->setting_company_address_2 : ''),
                'class'       => 'field',
                 // 'required'  =>'required'
               );
            
            echo form_input($data);
            ?>
<!--             <span class="input-is-required">*</span>-->
            <span class="alert-danger"><?php echo form_error('setting_company_address_2') ?></span>
            
        </div>
        
         <div class="form-group">
            <?php echo form_label('', 'setting_company_address_3') ?>
            <?php
              $data = array(
                'name'        => 'setting_company_address_3',
                'id'          => 'setting_company_address_3',
                'value'       => set_value('setting_company_address_3', (!empty($settings)) ? $settings->setting_company_address_3 : ''),
                'class'       => 'field',
                 // 'required'  =>'required'
               );
            
            echo form_input($data);
            ?>
<!--             <span class="input-is-required">*</span>-->
            <span class="alert-danger"><?php echo form_error('setting_company_address_3') ?></span>
            
        </div>
        
     
        
         <div class="form-group">
            <?php echo form_label('Town', 'setting_company_town') ?>
            <?php
              $data = array(
                'name'        => 'setting_company_town',
                'id'          => 'setting_company_town',
                'value'       => set_value('setting_company_town', (!empty($settings)) ? $settings->setting_company_town : ''),
                'class'       => 'field',
                'required'  =>'required'
               );
            
            echo form_input($data);
            ?>
              <span class="input-is-required">*</span>
            <span class="alert-danger"><?php echo form_error('setting_company_town') ?></span>
            
        </div>
        
         <div class="form-group">
            <?php echo form_label('County', 'setting_company_county') ?>
            <?php
              $data = array(
                'name'        => 'setting_company_county',
                'id'          => 'setting_company_county',
                'value'       => set_value('setting_company_county', (!empty($settings)) ? $settings->setting_company_county : ''),
                'class'       => 'field'
               );
            
            echo form_input($data);
            ?>
              <span class="input-is-required">*</span>
            <span class="alert-danger"><?php echo form_error('setting_company_county') ?></span>
            
        </div>
        
        
         <div class="form-group"> 
            <?php echo form_label('Postcode', 'setting_company_postcode') ?>
            <?php
              $data = array(
                'name'        => 'setting_company_postcode',
                'id'          => 'setting_company_postcode',
                'value'       => set_value('setting_company_postcode', (!empty($settings)) ? $settings->setting_company_postcode : ''),
                'class'       => 'field',
                'required'  =>'required'
               );
            
            echo form_input($data);
            ?>
             <span class="input-is-required">*</span>
	     <span class="alert-danger"><?php echo form_error('setting_company_postcode') ?></span>
            
        </div>
	 <div class="form-group"> 
            <?php echo form_label('Country', 'setting_company_country') ?>
            <?php
              $data = array(
                'name'        => 'setting_company_country',
                'id'          => 'setting_company_country',
                'value'       => set_value('setting_company_country', (!empty($settings)) ? $settings->setting_company_country : ''),
                'class'       => 'field',
                'required'  =>'required'
               );
            
            echo form_input($data);
            ?>
             <span class="input-is-required">*</span>
            <span class="alert-danger"><?php echo form_error('setting_company_country') ?></span>
            
        </div>
  
        
        <div class="form-group ">
            
            <?php 
                
                    echo form_submit('save_company_details', "Save Company Details", 'class="btn btn-primary"');
                 
             ?>
        </div>
        
        <?php echo form_close()?>
       
        <br/>
    </div>
    
  
</div>