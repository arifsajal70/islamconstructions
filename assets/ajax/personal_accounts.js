window.addBalanceTable = $("#addBalanceTable").dataTable({
	ajax : baseUrl+'personal_accounts/add_balance_table',
	dom: 'Bfrtip',
	buttons: [
		{
			extend: 'pdfHtml5',
			exportOptions:{columns: '0,1,2,3,5'},
			title: function(){return 'Islam Constructions - Add Balances'}
		},
		{
			extend: 'excelHtml5',
			exportOptions:{columns: '0,1,2,3,5'},
			title: function(){return 'Islam Constructions - Add Balances'}
		},
		{
			extend: 'print',
			exportOptions:{columns: '0,1,2,3,5'},
			title: function(){return 'Islam Constructions - Add Balances'}
		},
	]
});

$("[href=\"#expensed\"]").click(function(){
	window.expenseTable = $("#expenseTable").dataTable({
		ajax : baseUrl+'personal_accounts/expense_table',
		destroy: true,
		dom: 'Bfrtip',
		buttons: [
			{
				extend: 'pdfHtml5',
				exportOptions:{columns: '0,1,2,3,5'},
				title: function(){return 'Islam Constructions - Add Balances'}
			},
			{
				extend: 'excelHtml5',
				exportOptions:{columns: '0,1,2,3,5'},
				title: function(){return 'Islam Constructions - Add Balances'}
			},
			{
				extend: 'print',
				exportOptions:{columns: '0,1,2,3,5'},
				title: function(){return 'Islam Constructions - Add Balances'}
			},
		]
	});
});

$("[href=\"#report\"]").click(function(){
	jQuery.ajax({
		type: "GET",
		url: 'personal_accounts/report',
		success:function(response){
			var report = JSON.parse(response);
			console.log(report);
			if(report.status === "success"){
				var balance_report = report.balance;
				var expense_report = report.expense;
				var myChart = Highcharts.chart('accounts-chart', {
					chart: {
						type: 'areaspline'
					},
					title: {
						text: 'Accounts Report'
					},
					xAxis: {
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
					},
					yAxis: {
						title: {
							text: 'Amount'
						}
					},
					series: [{
						name: 'Income',
						color: '#F44236',
						data: balance_report
					}, {
						name: 'Expense',
						color: '#43B968',
						data: expense_report
					}]
				});

			}
		}
	});
});



function edit(url){
	$("[data-target=\"#editBalance\"]").click();
	jQuery.ajax({
		type: "GET",
		url: url,
		success:function(response){
			var alert = JSON.parse(response);
			if(alert.status === "success"){
				var data = JSON.parse(alert.message)[0];
				$("#editForm input[name=title]").val(data.title);
				$("#editForm textarea[name=note]").val(data.note);
				$("#editForm input[name=amount]").val(data.amount);
				$("#editForm input[name=date]").val(data.date);
				if($("#expenseTable").is(':visible')){
					$("#editForm").attr('action',baseUrl+'personal_accounts/edit_expense/'+data.ID);
				}else{
					$("#editForm").attr('action',baseUrl+'personal_accounts/edit_balance/'+data.ID);
				}
			}
		}
	});
}

$(function () {


});
































