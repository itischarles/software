/* 
 * all these relates to products
 */








/**
 * this is used when creating new invoice and we want to load products options
 * @returns {Boolean}
 */

//$(function(){
//    //loadProductOptions();
//});



  $(function() {
      
      var product_option_name = '';
      var product_option_charge = '';
      var product_optionID = '';
      var products_productID = '';
      
      //$( ".billing-opt-action" ).button().on( "click", function() {
       $(document).on("click",".billing-opt-action",function() {
   
        product_option_name =  $(this).parents('tr').children('td.product_option_name') .html();
        product_option_charge =  $(this).parents('tr').children('td.product_option_charge') .html();
        
        product_optionID =  $(this).parents('tr').children('td').children('span.product_optionID') .html();
        products_productID =  $(this).parents('tr').children('td').children('span.products_productID') .html();
   
        dialog.dialog( "open" );
	
	//since we are editing the products billing options, lets populate the form with the 
	//data we are editing
         pre_populateForm();
     
    });
    
    var dialog, form;
    
   
 
    dialog = $( "#editProductOption_dialog" ).dialog({
      autoOpen: false,
      height: 400,
      width: 450,
      modal: true,
      buttons: {
        "Update": updateProductBillingOption,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
      }
    });
 
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
     event.preventDefault();
      updateProductBillingOption();
    });
 
   
   //ADD PRODUCT BILLING OPTION
   $('#addProductBillingOption_btn').on('click', function(){
	openProductBillingOptionForm();
   });
   
   
   
    
    // add the value of the edited record into the dialog form
    function pre_populateForm(){
        $('#editProductOption_dialog #optionName').val(product_option_name);
        $('#editProductOption_dialog #optionCharge').val(product_option_charge);
        $('#editProductOption_dialog #product_optionID').val(product_optionID);
        $('#editProductOption_dialog #products_productID').val(products_productID);
    }
    
   
    function updateProductBillingOption() {  
    
        $.ajax({
            type : 'POST',
            //url : form.attr("action"),
            url   : jsconfig.baseurl+"products/edit-product-billing-option",
            data : form.serialize(),
            dataType: "json",
            success : function(response) {

            }
        }).fail(function() { //change the error handler to use ajax callback because of the async nature of Ajax
            alert("there was error adding this item");

           // attempts++;
        }).done(function(response) {

            if(response.error == 1){

                $('#option-feedback-msg').addClass('alert-danger');
                $('#option-feedback-msg').addClass('alert');
                $('#option-feedback-msg').html(response.error_msg);
            }
            else{
                $('#option-feedback-msg').removeClass('alert-danger');
                $('#option-feedback-msg').addClass('alert');
                $('#option-feedback-msg').addClass('alert-success');
                $('#option-feedback-msg').html(response.success_msg);
                $('#product-billing-option-list-wrapper').html(response.productOptReload);
                dialog.dialog( "close" );
            }

        }); 
    }
    
   
   
});



/**
 * we want to disable the btn to add new billing because we want to add the options
 * one at a time
 * @returns {undefined}
 */
function  disableAddProductBillingOptionBtn(){
     $('#addProductBillingOption_btn').attr('disabled','disabled');
}
 
 /**
 * now enable the btn to add new billing when you are ready
 * one at a time
 * @returns {undefined}
 */
function  enableAddProductBillingOptionBtn(){
    $('#addProductBillingOption_btn').removeAttr('disabled','disabled');
}

/**
 * click to add new product billing option.
 * open form on click
 * @returns {undefined}
 */
function openProductBillingOptionForm(){
    var rowCount = $('#product-billing-option-list tbody tr').length + 1;
    
    $('#product-billing-option-list tbody').append(
          //  
            "<tr class='row_"+rowCount+"'>"+
               
                "<td>"+rowCount+"</td>"+
                "<td> <input type='text' id='billing_option_name' size='10'> </td>"+
                "<td> <input type='text' id='billing_option_charge' class='field price_field' size='6'> </td>"+
                "<td>"+
                    "<select id='isTimeCharged'>"+
                        "<option value='0'>No</option>"+
                        "<option value='1'>Yes</option>"+
                    "</select>"+
                "</td>"+
                "<td> "+
                "<input type='submit' name='submit' value='Save' class='btn' onclick = 'return saveNewProductBillingOpt()'>"+
                "<a class='btn' onclick = 'return closeProductBillingOptionForm(\"row_"+rowCount+"\")'>Cancel</a>"+
                "</td>"+
             
            "</tr>"
         
    );
    
    // disable the add button until this action is complete or cancled
    disableAddProductBillingOptionBtn();
}

/**
 * if you decide not to add new billing option, cancel to remove form
 * @param {string} row
 * @returns {undefined}
 */
function closeProductBillingOptionForm(row){
     $('.'+row).remove();
     // enable the add btn and ready to add again
    enableAddProductBillingOptionBtn();
}



/**
 * now new product billing option form has been opened and data supplied, lets save it to DB

 * @returns {undefined}
 */
function saveNewProductBillingOpt(){
   
   var billingOptName = $('#product-billing-option-list tbody #billing_option_name').val();
   var billingOptCharge = $('#product-billing-option-list tbody #billing_option_charge').val();
   var isTimeCharged = $('#product-billing-option-list tbody #isTimeCharged').val();
   var productID = $('#productID').val();

    $.ajax({
            // config object defined in footer.php
            type : 'POST', 
            url :  jsconfig.baseurl +"products/add-new-product-billing-option",
            dataType: "json",
            data : {OptName:billingOptName, OptCharge: billingOptCharge, isTimeCharged:isTimeCharged,
                        productID:productID, add_product_opt:'submit'},
            success : function(response) {

            }
        }).fail(function() { //change the error handler to use ajax callback because of the async nature of Ajax
            alert("there was error adding this item");

        }).done(function(response) {
           // console.log(response.error);
            if(response.error == 1){
                
                $('#option-feedback-msg').addClass('alert-danger');
                $('#option-feedback-msg').addClass('alert');
                $('#option-feedback-msg').html(response.error_msg);
            }
            else{
                $('#option-feedback-msg').removeClass('alert-danger');
                $('#option-feedback-msg').addClass('alert');
                $('#option-feedback-msg').addClass('alert-success');
                $('#option-feedback-msg').html(response.success_msg);
                $('#product-billing-option-list-wrapper').html(response.productOptReload);
		
		// enable the add btn and ready to add again
		enableAddProductBillingOptionBtn();
            }
  
            
    });

}




/**
 * remove/disable the chosen option
 * @param {int} billing_optionID
 * @param {int} productID
 * @returns {Boolean}
 */
function removeBillingOptions(billing_optionID, productID){
    var answer = confirm("Are you sure you want to remove this billing option?")
    if (answer){ 
        //return true; 
        $.ajax({
            // config object defined in footer.php
            type : 'POST', 
            url :  jsconfig.baseurl +"products/remove-product-billing-option",
            dataType: "json",
            data : {billing_optionID:billing_optionID, productID: productID, delete_product_opt:'submit'},
            success : function(response) {

            }
        }).fail(function() { //change the error handler to use ajax callback because of the async nature of Ajax
            alert("there was error adding this item");

        }).done(function(response) {
           // console.log(response.error);
            if(response.error == 1){
                
                $('#option-feedback-msg').addClass('alert-danger');
                $('#option-feedback-msg').addClass('alert');
                $('#option-feedback-msg').html(response.error_msg);
            }
            else{
                $('#option-feedback-msg').removeClass('alert-danger');
                $('#option-feedback-msg').addClass('alert');
                $('#option-feedback-msg').addClass('alert-success');
                $('#option-feedback-msg').html(response.success_msg);
                $('#product-billing-option-list-wrapper').html(response.productOptReload);
            }
             //console.log(response);
            
    });
    }
    else{ 
        return false;  
    }       
       return false;
}












/**
 * from loadProductOptions form, when the radio button is clicked,
 * activate the chosen row. we do this because we have multiple option per radio button.
 * to identify the chosen option, we have to have a way to do it
 * @param {type} row_num
 * @returns {undefined}
 */
function activateBillingOptionRow_BK(row_num){
   //var chosenRow = $('#billingOption .'+row_num).html();
   $('#billingOption #chosenOption_charge').val('product_option_charge'+row_num);
   $('#billingOption #chosenOption_Date').val('clients_invoicng_date'+row_num);
   
   // console.log(chosenRow);
}

function loadProductOptions_BK(){
   
   // since this file is always loaded lets stop the script if current page isn't where we want
    if($('#loadProductOptions').length < 1){
	return false;
    }
    
    var productID = $('#loadProductOptions').val();
    var clientID = $('#clientID').val();
    
        $.ajax({
            // config object defined in footer.php
            type : 'POST', 
            url :  jsconfig.baseurl +"products/listBillingOptions",
            dataType: "json",
            data : {clientID:clientID, productID: productID, load_options:'submit'},
            success : function(response) {

            }
        }).fail(function() { //change the error handler to use ajax callback because of the async nature of Ajax
            alert("there was error adding this item");

        }).done(function(response) {
           // console.log(response.error);
            if(response.error == 1){
                
//                $('#option-feedback-msg').addClass('alert-danger');
//                $('#option-feedback-msg').addClass('alert');
//                $('#option-feedback-msg').html(response.error_msg);
            }
            else{
		var html = '';
		var info = '';
		var counter = 1;
		
		 html+= "<tr>"+
			    "<th>Name </th>"+
			    "<th> Charge (&pound;)</th>"+
			    "<th>Invoice date </th>"+
			    "<th> Product Ref.</th>"+
			    "<th>Info </th>"+
			    "</tr>";
		
		
		$.each(response.productOpts, function(i, obj){
		    
		    if(obj.product_option_charge_is_reoccuring == 1){
			info =  "This will be a re-occurring invoice";
		    }else{
			info =  "This will be a One-Off invoice";
		    }
		    html+= "<tr class='_"+counter+"'>"+
			    "<td>"+
				    "<input type='radio' name='product_optionID' value='"+obj.product_optionID+"' onclick = 'activateBillingOptionRow(\"_"+counter+"\")'/>&nbsp;&nbsp;"+
				    obj.product_option_name+
			    "</td>"+
			    "<td>"+
				    "<input type='text' name='product_option_charge_"+counter+"' size='6' value='"+obj.product_option_charge+"'/>"+
				   
			    "</td>"+
			    "<td>"+
				    "<input type='text' name='clients_invoicng_date_"+counter+"' size='8' value='"+obj.clients_invoicng_date+"'/>"+
				   
			    "</td>"+
			    "<td> "+obj.product_ref	+"</td>"+
			    "<td>"+
				"<a title='"+info+"!'  data-toggle='tooltip' class='pointer' >"+
				    "<span class='glyphicon glyphicon-question-sign'></span>"+
				"</a>"+
			    "</td>"+
			    "</tr>";
		    
		    counter++;
		});
		
		html+= "<tr>"+
		    "<td colspan='100%'>"+
			   "<input type='hidden' value='' name='chosenOption_charge' id='chosenOption_charge'/>"+
			   "<input type='hidden' value='' name='chosenOption_Date' id='chosenOption_Date'/>"+
		    "</td>"+
		    
		    "</tr>";
		$('#loadBillingOptions table').html(html);
//                $('#option-feedback-msg').removeClass('alert-danger');
//                $('#option-feedback-msg').addClass('alert');
//                $('#option-feedback-msg').addClass('alert-success');
//                $('#option-feedback-msg').html(response.success_msg);
//                $('#product-billing-option-list-wrapper').html(response.productOptReload);
            }
             //console.log(response);
            
    });
}


