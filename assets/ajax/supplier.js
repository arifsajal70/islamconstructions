$(document).ready(function() {
    window.suppliersTable = $("#suppliersTable").dataTable({
        ajax : baseUrl+'suppliers/suppliers_table',
        dom: 'Bfrtip',
		buttons: [
			{
				extend: 'pdfHtml5',
				exportOptions:{columns: '0,1,2,3,5'},
				title: function(){return 'Islam Constructions - Admins'}
			},
			{
				extend: 'excelHtml5',
				exportOptions:{columns: '0,1,2,3,5'},
				title: function(){return 'Islam Constructions - Admins'}
			},
			{
				extend: 'print',
				exportOptions:{columns: '0,1,2,3,5'},
				title: function(){return 'Islam Constructions - Admins'}
			},
		]
    });
});

//after clicking Payments
$("[href=\"#supplier-payments\"]").click(function(){
	window.sitePaymentsTable = $("#sitePaymentsTable").dataTable({
		ajax : baseUrl+'payments/supplier_payments_table/'+pro.ID,
		dom: 'Bfrtip',
		destroy: true,
		buttons: [
			{
				extend: 'pdfHtml5',
				exportOptions:{columns: '0,1,2,3'},
				title: function(){return pro.name+' ( Supply Site ) - Payment Statement'}
			},
			{
				extend: 'excelHtml5',
				exportOptions:{columns: '0,1,2,3'},
				title: function(){return pro.name+' ( Supply Site ) - Payment Statement'}
			},
			{
				extend: 'print',
				exportOptions:{columns: '0,1,2,3'},
				title: function(){return pro.name+' ( Supply Site ) - Payment Statement'}
			},
		]
	});

	jQuery.ajax({
		type : "GET",
		url : baseUrl+"payments/payments_report_for_supplier/"+pro.ID,
		success:function(response){
			var data = JSON.parse(response);
			if(data.status === "success"){
				$("#payments-report").html(data.message);
			}else{
				$("#payments-report").html(data.message);
			}
		}
	});
});
//end after clicking Payments

//after clicking Bills
$("[href=\"#supplier-bills\"]").click(function(){
	window.siteBillsTable = $("#siteBillsTable").dataTable({
		ajax : baseUrl+'bills/supplier_bills_table/'+pro.ID,
		dom: 'Bfrtip',
		destroy: true,
		buttons: [
			{
				extend: 'pdfHtml5',
				exportOptions:{columns: '0,1,2,3,4,5,6'},
				title: function(){return pro.name+' ( Supply Site ) - Bill Statement'}
			},
			{
				extend: 'excelHtml5',
				exportOptions:{columns: '0,1,2,3,4,5,6'},
				title: function(){return pro.name+' ( Supply Site ) - Bill Statement'}
			},
			{
				extend: 'print',
				exportOptions:{columns: '0,1,2,3,4,5,6'},
				title: function(){return pro.name+' ( Supply Site ) - Bill Statement'}
			},
		]
	});
});
//end after clicking Bills

function edit(url){
    $("button[data-target=\"#editingModal\"]").click();
    jQuery.ajax({
        type: "GET",
        url: url,
        success:function(response){
            var alert = JSON.parse(response);
            if(alert.status === "success"){
                var data = JSON.parse(alert.message)[0];
                $("#editForm input[name=name]").val(data.name);
                $("#editForm input[name=email]").val(data.email);
                $("#editForm input[name=phone]").val(data.phone);
                $("#editForm textarea[name=address]").val(data.address);
                $("#editForm").attr('action',baseUrl+'suppliers/edit/'+data.ID);
            }
        }
    });
}

function view(url){
    if($("#eng-table-view").is(":visible")){
        $("#eng-table-view").slideUp();
        $("button[data-target=\"#addingModal\"]").hide();
        $("#back").show();
        $("#profile-view").slideDown();

        jQuery.ajax({
            type : "GET",
            url : url,
            success:function(response){
                var data = JSON.parse(response);
                if(data.status === "success"){
                    window.pro = JSON.parse(data.message)[0];
                    $("#profile-image").attr('src',baseUrl+'uploads/'+pro.photo);
                    $("#profile-name").html(pro.name);
                    $("#profile-email").html(pro.email);
                    $("#profile-call-now").attr('href',"tel:"+pro.phone);

					//setting profile Information
					$("[for='name']").html(pro.name);
					$("[for='email']").html(pro.email);
					$("[for='phone']").html(pro.phone);
					$("[for='address']").html(pro.address);
					$("[for='document']").attr('onclick','download("engineers","'+pro.ID+'")');

					$("#billForm").attr('action',baseUrl+'bills/add_for_supplier/'+pro.ID);
					$("#paymentForm").attr('action',baseUrl+'payments/add_for_supplier/'+pro.ID);

                }else if(data.status === "error"){
                    alert('No Profile Found');
                    $("#back").click();
                }else{
                    $("#back").click()
                }
            }
        });
    }
}

$("#back").click(function(){
    $("#eng-table-view").slideDown();
    $("button[data-target=\"#addingModal\"]").show();
    $("#back").hide();
    $("#profile-view").slideUp();
});
