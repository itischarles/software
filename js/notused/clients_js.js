/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




$(function(){
   var clientID = $('#clientID').val();
   
//   console.log(clientID);
//   
//   return false;
   
    $.ajax({
	url: jsconfig.baseurl+"dashboard/num-of-events?clientID="+clientID,
	type: 'GET',
	async: true,
	dataType: "json",
	success: function (response) {
	    client_invoiceNumberOfEvents(response.series, response.categories)
	}
    });
    
   /* 
    //display cash flow
    $.ajax({
	url: jsconfig.baseurl+"dashboard/invoice-cash-flow",
	type: 'GET',
	async: true,
	dataType: "json",
	success: function (response) {
	    //visitorData(data);
	
	    dashboard_invoiceCashFlow(response.series, response.categories)
	}
    });
    
    */
});



/**
 * count how many were created, processed and completed
 * @param {type} data
 * @param {type} categories
 * @returns {undefined}
 */
function client_invoiceNumberOfEvents(data,categories ){
    $('#client_chart_count_events').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: 'Invoice Summary'
    },
    subtitle: {
            text: 'counting the number of cases'
        },
    xAxis: {
        categories:categories,
	 crosshair: true
    },
    yAxis: {
	min: 0,
        title: {
            text: 'Number of Events'
        }
    },
    plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
    series: data
  });
}



/**
 * display total cash flow by month
 * @param {type} data
 * @param {type} categories
 * @returns {undefined}
 */

function client_invoiceCashFlow(data,categories ){
    $('#chart_invoice_cashflow').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: 'Cash Flow (£)'
    },
    subtitle: {
            text: 'Monthly Invoice Amount'
        },
    xAxis: {
        categories:categories,
	 crosshair: true
    },
    yAxis: {
	min: 0,
        title: {
            text: 'Amount (£)'
        },
	labels: {
                overflow: 'justify'
            }
    },
//    credits: {
//	enabled: false
//    },
    tooltip: {
       // pointFormat: "Total amount: £{point.y:.2f}",
	formatter: function() {
      //  return 'Total amount <b>' + this.x + '</b> is <b>' + this.y + '</b>, in series '+ this.series.name;
	return this.series.name + ' in ' + this.x + ' is £' + this.y.toFixed(2) ;
	}
    },
    plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: '2'
            }
        },
    series:  data
	    
  });
}
