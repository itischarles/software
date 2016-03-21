/* 
 *
 */


  $(function() {
    var dialog, form;
    
    //  productID = $( "#productID" ),
     // billing_option = $( "#billing_option" ),
     // invoice_item_sub_total = $( "#invoice_item_sub_total" );
      
      invoice_loadProductOptions();
    
    
    function addInvoiceItems() { 
    
	$.ajax({
	    type : form.attr("method"), // there is no type attribute, it is method in the form
	    url : form.attr("action"),
	    data : form.serialize(),
	    success : function(response) {

	    }
	}).fail(function() { //change the error handler to use ajax callback because of the async nature of Ajax
	    alert("there was error adding this item");

	}).done(function(response) {
	    if(response.error == 1){
		$('#feedback_msg').html("<div class='alert alert-danger'> "+response.error_msg+" </div>");

		return false;
	     }
	     else{
		 dialog.dialog( "close" );
		 reloadInvoiceTheme(); 
	     }
	});
    }
    
    function invoice_loadProductOptions(){
	// since this file is always loaded lets stop the script if current page isn't where we want
	
	
	//console.log(product_optionID)
	if($('#product_optionID').length < 1){
	    return false;
	}

	var product_optionID = $("#product_optionID").val();
	var productID = $("#productID").val();
	//console.log(productID)
	 $.ajax({
            // config object defined in footer.php
            type : 'POST', 
            url :  jsconfig.baseurl +"products/getProductBillingOption",
            dataType: "json",
            data : {product_optionID:product_optionID, productID: productID, getOptions:'submit'},
            success : function(response) {

            }
        }).fail(function() { //change the error handler to use ajax callback because of the async nature of Ajax
            alert("there was error adding this item");

        }).done(function(response) {
           // console.log(response.error);
            if(response.error == 1){
               $('#feedback_msg').html("<div class='alert alert-danger'> "+response.error_msg+" </div>");
            }
            else{
		$('#invoice_item_sub_total').val(response.productOpts.product_option_charge);
		//$('#general_date1').val(response.product_option_charge);
//      
            }
    });
    }
    
   
    
    
    function reloadInvoiceTheme(){
         $.ajax({
	    type : 'POST', 
	    url :  window.location.href,
	  //  data : form.serialize(),
	    success : function(response) {

	    }
	}).fail(function() { //change the error handler to use ajax callback because of the async nature of Ajax
	    alert("there was error adding this item");

	}).done(function(response) {
	     console.log(response);
	    $('#invoice-theme-wrapper').html(response);
	});
    }
 
    dialog = $( "#invoices_dialog_form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 450,
      modal: true,
      buttons: {
        "Add Invoice Item": addInvoiceItems,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        //allFields.removeClass( "ui-state-error" );
      }
    });
 
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
     event.preventDefault();
      addInvoiceItems();
    });
 
    $( "#add_invoice_items_popup" ).button().on( "click", function() {
      dialog.dialog( "open" );
     
    });
    
    
    
  });


 function invoice_removeInvoiceItem(clientID, invoiceID, invoiceItemID){
	
    }