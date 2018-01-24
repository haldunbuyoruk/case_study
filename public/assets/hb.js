$(document).ready(() => {

	var tabs = $('.campaign-tabs');
	if(tabs.length > 0){
		tabs.map((key, value) =>{
			getProducts($(value).attr('data-id'), $(value).attr('data-slug'));
		});
	}

	var report = $('#report');

	if(report.length > 0 ){
		$(report).dataTable({
			"dom": '<"top"f>rt<"bottom"p><"clear">'
		});
	}

	$('#startDate').datepicker({dateFormat: 'dd-mm-yy',  minDate: new Date()});
	$('#endDate').datepicker({dateFormat: 'dd-mm-yy',  minDate: new Date()});
	$('#startDate').datepicker('setDate', new Date(new Date().setDate(new Date().getDate())));
	$('#endDate').datepicker('setDate', new Date(new Date().setDate(new Date().getDate() + 1)));
});

function openCalender(name){
	 $( "#"+name ).datepicker( "show" );
}

function getProducts(tabID, slug){
	$.ajax({
	    type : 'GET',
	    url:'/tabs/'+tabID+'/'+slug,
	    dataType: 'json',
	    success: (data) => {
	    	var html = '';
	    	data.map((value, key) => {
	    		html += '<div class="col-md-3 mrg-top" id="'+value.productID+'"><a target="_blank" href="'+value.url+'"><img class="object-fit_contain" src="'+value.imagesrc+'" /></a></div>';
	    	});

	    	$('#'+tabID).html(html);
	    }
	});
}


function track(campaign, tabID = -1, productID = 0){
	$.ajax({
	    type : 'POST',
	    url:'/track/',
	    data:{
	    	"campaign": campaign,
	    	"tabID": tabID,
	    	"productID": productID,
	    	"resolution": screen.width+'x'+ screen.height
	    },
	    dataType: 'json',
	    success: (data) => {
	    	console.log(data);
	    }
	});
}

function getTracking(){
	$.ajax({
	    type : 'POST',
	    url:'/trackReport/',
	    data : {
	    		'campaign' : $('#campaign option:selected').val(),
	    		'start_date' : $('#startDate').val(),
	    		'end_date' : $('#endDate').val(),
	    		'tab_id' : $('#tab_id option:selected').val(),
	    		'product_id' : $('#product_id option:selected').val(),
	    },
	    dataType: 'json',
	    success: (data) => {
	    	var table = $('#report').DataTable();
	    	table
	    	    .clear()
	    	    .draw();
	    	data.result.map((value, key) => {
	    		table.row.add( [ value.timestamp,value.ip,value.resolution,value.useragent,value.campaign,value.tab_id,value.product_id ]).draw();
	    	});
	    }
	});
}