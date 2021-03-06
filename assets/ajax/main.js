$("form").submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    jQuery.ajax({
        url : $(this).attr('action'),
        type : $(this).attr('method'),
        data : formData,
        success:function(response){
            var alert = JSON.parse(response);
            if(alert.status == "success"){
                reloadTable();
                toastr['success'](alert.message);
				if($(".form").is(":visible")){
					setTimeout(function(){
						window.location = baseUrl+'profile';
					},3000);
				}
				$("form input,textarea,select").val('');
				$('.dropify-clear').click();
                $("button[data-dismiss=\"modal\"]").click();
                if($("#stock-report").is(":visible")){
                    $("[href=\"#construction-site-stock\"]").click();
                }
                if($("#accounts-report").is(":visible")){
                    $("[href=\"#construction-site-accounts\"]").click();
                }
                if($("#payments-report").is(":visible")){
                    $("[href=\"#supply-site-payments\"]").click();
					$("[href=\"#supplier-payments\"]").click();
                }
            }else if(alert.status == "error"){
                toastr['error'](alert.message);
            }else if(alert.status == "warning"){
                toastr['warning'](alert.message);
            }else{
                toastr['error'](alert);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

$(".select2").each(function () {
    $(this).select2();
});
$(".dropify").each(function () {
    $(this).dropify();
});
$(".datepicker").each(function () {
    $(this).datepicker({
        format: "yyyy-mm-dd",
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
    });
});

$("#dataTables").dataTable();

$('table').on('draw.dt', function() {
    $('[data-toggle="tooltip"]').tooltip();
});

function password_change(url){
    $("[data-target=\"#passChangeModal\"]").click();
    $("#passchange").attr('action',url);
}

function deleteElelm(url){
    swal({
        title: 'Are you sure?',
        text: "You won't be able undo this Action",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'delete',
        cancelButtonText: 'cancel',
        confirmButtonClass: 'btn btn-primary btn-lg mr-1',
        cancelButtonClass: 'btn btn-danger btn-lg',
        buttonsStyling: true
    }).then(function(isConfirm){
        if (isConfirm === true){
            jQuery.ajax({
                type: "POST",
                url: url,
                success:function(response){
                    var data = JSON.parse(response);
                    if(data.status === 'success'){
                        reloadTable();
                        swal({
                            title: 'Deleted!',
                            text: data.message,
                            type: 'success',
                            confirmButtonClass: 'btn btn-primary btn-lg',
                            buttonsStyling: false
                        });
                        if($("#stock-report").is(":visible")){
                            $("[href=\"#construction-site-stock\"]").click();
                        }
                        if($("#accounts-report").is(":visible")){
                            $("[href=\"#construction-site-accounts\"]").click();
                        }
                        if($("#payments-report").is(":visible")){
                            $("[href=\"#supply-site-payments\"]").click();
							$("[href=\"#supplier-payments\"]").click();
                        }
                    }else if(data.status === "error"){
                        swal({
                            title: 'Not Deleted!',
                            text: data.message,
                            type: 'error',
                            confirmButtonClass: 'btn btn-primary btn-lg',
                            buttonsStyling: false
                        });
                    }
                }
            });

        }else if (isConfirm === false){
            swal({
                title: 'Cancelled',
                text: 'You Calcelled The Action',
                type: 'error',
                confirmButtonClass: 'btn btn-primary btn-lg',
                buttonsStyling: false
            });
        }
    })
}

function download(table,ID){
    window.open(baseUrl+'documents/download/'+table+'/'+ID);
}

function switchStatus(url){
    jQuery.ajax({
        type : "GET",
        url : url,
        success:function(response){
            var alert = JSON.parse(response);
            if(alert.status === "success"){
                reloadTable();
                toastr['success'](alert.message);
            }else if(alert.status === "error"){
                toastr['error'](alert.message);
            }else{
                toastr['success'](alert);
            }
        }
    });
}

function reloadTable(){
    if($("#engineersTable").is(":visible")){
        engineersTable.fnReloadAjax();
    }else if($("#managersTable").is(":visible")){
        managersTable.fnReloadAjax();
    }else if($("#employeesTable").is(":visible")){
        employeesTable.fnReloadAjax();
    }else if($("#sitesTable").is(":visible")){
        sitesTable.fnReloadAjax();
    }else if($("#itemsTable").is(":visible")){
        itemsTable.fnReloadAjax();
    }else if($("#siteStockTable").is(":visible")){
        siteStockTable.fnReloadAjax();
    }else if($("#adminsTable").is(":visible")){
        adminsTable.fnReloadAjax();
    }else if($("#siteAccountsTable").is(":visible")){
        siteAccountsTable.fnReloadAjax();
    }else if($("#siteDocumentsTable").is(":visible")){
        siteDocumentsTable.fnReloadAjax();
    }else if($("#siteBillsTable").is(":visible")){
        siteBillsTable.fnReloadAjax();
    }else if($("#suppliersTable").is(":visible")){
        suppliersTable.fnReloadAjax();
    }else if($("#sitePaymentsTable").is(":visible")){
        sitePaymentsTable.fnReloadAjax();
    }else if($("#employeeTypeTable").is(":visible")){
        employeeTypeTable.fnReloadAjax();
    }else if($("#siteemployeesTable").is(":visible")){
        siteemployeesTable.fnReloadAjax();
    }else if($("#salaryTable").is(":visible")){
        salaryTable.fnReloadAjax();
    }else if($("#siteManagersTable").is(":visible")){
        siteManagersTable.fnReloadAjax();
    }else if($("#currentWorksTable").is(":visible")){
		currentWorksTable.fnReloadAjax();
    }else if($("#addBalanceTable").is(":visible")){
		addBalanceTable.fnReloadAjax();
    }else if($("#expenseTable").is(":visible")){
		expenseTable.fnReloadAjax();
    }
}

$(document).ajaxStart(function(event,request,settings ) {
    if($('.modal-content').is(":visible")){
        $(".modal-content").append( "<div class=\"preloader\"></div>" );
    }else{
        $("body").append( "<div class=\"preloader\"></div>" );
    }
});

$(document).ajaxComplete(function(event,request,settings ) {
    $(".preloader").fadeOut(function(){
        $("div").remove('.preloader');
    });
});
