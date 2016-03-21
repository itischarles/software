/* 
 *
 */


$(function() {
    
  
    var dialog, form;  
      
    
    
    dialog = $( "#searchAdviserDialog" ).dialog({
	autoOpen: false,
	height: 450,
	width: 600,
	modal: true,
  //      buttons: {
//	    "Add Invoice Item": invoice_addInvoiceItems,
//	      Cancel: function() {
//	      //dialog.dialog( "close" );
//		}
//      },
	buttons: [
		    {
			text: "Close",
			class: 'ui-OKButtonClass',
			click: function() {
			     dialog.dialog( "close" );
			}
		    }
		   // {
//			text: "Save",
//			class : 'saveButtonClass',
//			click: function() {
//			    // Save code here
//			}
		   // }
		],
	close: function() 
		{
		    form[ 0 ].reset();
		}
    });
 
 
    form = dialog.find( "form#advSearchResult" ).on( "submit", function( event ) {
	$("form#advSearchResult .alert").html();
	
	
	if($('form#advSearchResult input[name=adviserID]:checked').length<=0){
	     $("form#advSearchResult .alert").html("Please select an adviser").addClass('alert-danger');
	     
	      event.preventDefault();
	}      
    });
    
    
 
    $( "#searchAdviser" ).on( "click", function() {
      dialog.dialog( "open" );
     
    });
    
     $( "#s_advs" ).on( "click", function() {
	 
	 listAdvisers();
    });
 
    
    
    function listAdvisers() { 
   
	$.ajax({
	    type : form.attr("method"),
	   // url : form.attr("action"),
	    url :  jsconfig.baseurl +"advisers/xhttplist",
	   // data : form.serialize(),
	     data : $('form#advSearchForm').serialize(),
	    success : function(response) {

	    }
	}).fail(function() { //change the error handler to use ajax callback because of the async nature of Ajax
	    alert("there was error adding this item");

	}).done(function(response) {
	    if(response.error == 0){
		$.each(response.adv, function(index, val){
		   $('#advSearchResult table').append(
		    "<tr>"+
			 "<td><input type='radio' name='adviserID' value='"+val.code+"' /></td>"  +
			
			 "<td>"+val.name+"</td>"+
			  "<td>"+val.company+"</td>"+
			   "<td><button>Select</button></td>"+
		    "</tr>"
		   );
		})
	     }
	     
	});
    }
 	return false;
    
});



