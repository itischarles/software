/* 
 * 
 */


$(function(){
    
    /**
     * 
     * show tool tips on element 
     */
       $('[data-toggle="tooltip"]').tooltip();  
    
    
    
     $( "#dob_1, #dob_2" ).datepicker({
        minDate: new Date('01/01/1910'),
      //  minDate: new Date(1900, 11 - 1, 6),
        yearRange: '1900:'+ new Date(),
       maxDate: "-9Y +0M" ,
        dateFormat:'dd-mm-yy',
        showOn: "button",
        buttonImageOnly: true,
        buttonText: "cal",
        buttonImage: jsconfig.baseurl+"images/calendar.gif",
        changeMonth: true,
        changeYear: true    
    });
   
    
    // date from today to 2yrs + 10 days
    $( "#general_date1, #general_date2" ).datepicker({
        minDate: 0,
        maxDate: "+2Y +12M" ,
        dateFormat:'dd-mm-yy',
        showOn: "button",
        buttonImageOnly: true,
        buttonText: "cal",
          buttonImage: jsconfig.baseurl+"images/calendar.gif",
        changeMonth: true,
        changeYear: true    
    });
    
    
    // date from jan 2010 to today
    $( "#general_date2" ).datepicker({
        minDate: new Date('01/01/2010'),
        maxDate: new Date(),
        dateFormat:'dd-mm-yy',
        showOn: "button",
        buttonImageOnly: true,
	  buttonImage: jsconfig.baseurl+"images/calendar.gif",
        buttonText: "Cal",
        changeMonth: true,
        changeYear: true    
    });
    
     // date from jan 2010 to today
    $( "#general_date3" ).datepicker({
        minDate: new Date('01/01/2010'),
        maxDate: new Date(),
        dateFormat:'dd-mm-yy',
        showOn: "button",
        buttonImageOnly: true,
	 buttonImage: jsconfig.baseurl+"images/calendar.gif",
        buttonText: "Cal",
        changeMonth: true,
        changeYear: true    
    });
    
    
    /** DATE PICKER RANGE, **/
   
    $( "#general_range_from" ).datepicker({     
        minDate: new Date('01/01/2016'),
       // maxDate: new Date(),
	maxDate: "+3Y +12M" ,
        changeMonth: true,
        //dateFormat:'MM-yy',
        dateFormat:'dd-mm-yy',
        numberOfMonths: 1,
         buttonImageOnly: true,
        //buttonText: " . ",
          buttonImage: jsconfig.baseurl+"images/calendar.gif",
        changeYear: true ,    
        showOn: "button",
           
        showAnim:'slide',
        onClose: function( selectedDate ) {
            $( "#general_range_to" ).datepicker( 
                    "option", "minDate", selectedDate );
        }
     });
     
    $( "#general_range_to" ).datepicker({
       minDate: new Date('01/01/2016'),
       // maxDate: new Date(),
	maxDate: "+3Y +12M" ,
        changeMonth: true,
        dateFormat:'dd-mm-yy',
       // dateFormat:'MM-yy',
        numberOfMonths: 1,
         buttonImageOnly: true,
       // buttonText: " . ",
	  buttonImage: jsconfig.baseurl+"images/calendar.gif",
        changeYear: true ,
        showOn: "button",
           
        showAnim:'slide',
        onClose: function( selectedDate ) {
            $( "#general_range_from" ).datepicker( 
                "option", "maxDate", selectedDate );
        }

    });
    
    
    
   
   ///#########PRICE FORMATER###############/
    $('.price_field').priceFormat({
        prefix: '',
        centsSeparator: '.',
        thousandsSeparator: ',',
        allowNegative:true
    });
       
  
  
  //###### GRADDABLE CONTENT#####
    $( ".dragableDiv" ).draggable({
        addClasses: false
    });
    
    //##### SORTALE TABLE ######
    $(".isSortable").tablesorter();


    //####### clear flash message after 5sec #############
    clearContent('flash_message')
    
    
    //##### MAKE SIDEBAR GROW #################
    if(isMobileDevice() === true){
	// mobile device does not need sidebar to grow with content
    }else{
	makeSidebarGrow();
    }
  

});





/**
 * get confirmation before action
 * @param {string} message
 * @returns {Boolean}
 */
function get_confirmation(message){
     var answer = confirm(message)
	if (answer){ return true; }
       else{ return false;   }       
       return false;
}


function clearContent(div_id){
    setTimeout(function(){
	$('#'+div_id).fadeOut('slow');
    }, 1500);
}


function toggleElement(id){
    var link = $(this).text();
    //console.log(btn)
     $('#'+id).slideToggle('slow',function() {
//	if (link.is(':visible')) {
//             link.text('close');                
//        } else {
//             link.text('open');                
//        }  
      });
//    $('#'+id).toggle(function(){
//	//console.log(btn.value)
//    }, function(){
//	
//    })('slow');
}



/** I WANTED to get the side bar to have same height as the content area
 * base on the template and desing, i thought it will be quicker to use javascript to]
 * dynamically gte the width of the content area and add it to the sidebar
 * **/
function makeSidebarGrow(){
    var contentHeight= $( ".content" ).height();
    $('.sidebar').attr("style","min-height:"+contentHeight+"px");
    //console.log(contentHeight);
}


/**
 * check useragent
 * @returns {Boolean}
 */
function isMobileDevice() {
  try{ document.createEvent("TouchEvent"); return true; }
  catch(e){ return false; }
}