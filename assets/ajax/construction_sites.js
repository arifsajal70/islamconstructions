$(document).ready(function(){
    window.sitesTable = $("#sitesTable").dataTable({
        ajax : baseUrl+'sites/construction_site_table',
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                exportOptions:{columns: '0,1,2,3'},
                title: function(){return 'Islam Constructions - Construction Sites'}
            },
            {
                extend: 'excelHtml5',
                exportOptions:{columns: '0,1,2,3'},
                title: function(){return 'Islam Constructions - Construction Sites'}
            },
            {
                extend: 'print',
                exportOptions:{columns: '0,1,2,3'},
                title: function(){return 'Islam Constructions - Construction Sites'}
            },
        ]
    });
});

function view(url){
    if($("#site-table-view").is(":visible")){
        jQuery.ajax({
            type : "GET",
            url : url,
            success:function(response){
                var data = JSON.parse(response);
                if(data.status === "success"){
                    window.pro = JSON.parse(data.message)[0];
                    $("#site-table-view").slideUp();
                    $("button[data-target=\"#addingModal\"]").hide();
                    $("#back").show();
                    if(pro.sitetype === 'Construction'){
                        $("#construction-site-view").slideDown();
                    }else if(pro.sitetype === 'Supply'){
                        $("#supply-site-view").slideDown();
                    }
                    $(".site-image").attr('src',baseUrl+'uploads/'+pro.photo);
                    $(".site-name").html(pro.name);
                    $(".site-address").html(pro.address);
                    window.siteID = pro.ID;
                    $("#stockForm").attr('action',baseUrl+'stocks/add/'+pro.ID);
                    $("#transactionForm").attr('action',baseUrl+'transactions/add/'+pro.ID);
                    $("#documentForm").attr('action',baseUrl+'documents/add/'+pro.ID);
                    $("#employeeForm").attr('action',baseUrl+'employees/add_to_site/'+pro.ID);
                    //Getting Single Engineer Regurding This Site
                    jQuery.ajax({
                        url: baseUrl+'engineers/single_engineer/'+pro.engineerID,
                        type: "GET",
                        success:function(response){
                            var data = JSON.parse(response);
                            if(data.status === "success"){
                                var eng = JSON.parse(data.message)[0];
                                $("#engineer-name").html(eng.name);
                                $("#engineer-email").html(eng.email);
                                $("#callNow").attr('href','tel:'+eng.phone);
                                $("#textNow").attr('href','sms:'+eng.phone);
                            }else if(data.message === "error"){
                                toastr['error'](data.message);
                            }else{
                                toastr['error'](data.message);
                            }
                        }
                    });
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
                $("#editForm textarea[name=address]").val(data.address);
                $("#editForm input[name=created]").val(data.created);
                $("#editForm select[name=sitetype]").val(data.sitetype);
                $("#editForm select[name=engineerID]").val(data.engineerID).trigger('change.select2');
                $("#editForm").attr('action',baseUrl+'sites/edit/'+data.ID);
            }else{
                alert('No Engineer Found');
            }
        }
    });
}

//after clicking Stock
$("[href=\"#construction-site-stock\"]").click(function(){
    window.siteStockTable = $("#siteStockTable").dataTable({
        ajax : baseUrl+'stocks/stocks_table/'+siteID,
        dom: 'Bfrtip',
        destroy: true,
        buttons: [
            {
                extend: 'pdfHtml5',
                exportOptions:{columns: '0,1,2,3,4'},
                title: function(){return pro.name+' ( Construction Site )- Stock Report'}
            },
            {
                extend: 'excelHtml5',
                exportOptions:{columns: '0,1,2,3,4'},
                title: function(){return pro.name+' ( Construction Site )- Stock Report'}
            },
            {
                extend: 'print',
                exportOptions:{columns: '0,1,2,3,4'},
                title: function(){return pro.name+' ( Construction Site )- Stock Report'}
            },
        ]
    });

    jQuery.ajax({
        type : "GET",
        url : baseUrl+"stocks/stock/"+siteID,
        success:function(response){
            var data = JSON.parse(response);
            if(data.status === "success"){
                $("#stock-report").html(data.message);
            }else{
                $("#stock-report").html(data.message);
            }
        }
    });
});
//end after clicking stock

//after clicking Accounts
$("[href=\"#construction-site-accounts\"]").click(function(){
    window.siteAccountsTable = $("#siteAccountsTable").dataTable({
        ajax : baseUrl+'transactions/transactions_table/'+siteID,
        dom: 'Bfrtip',
        destroy: true,
        buttons: [
            {
                extend: 'pdfHtml5',
                exportOptions:{columns: '0,1,2,3,4'},
                title: function(){return pro.name+' ( Construction Site )- Accounts Report'}
            },
            {
                extend: 'excelHtml5',
                exportOptions:{columns: '0,1,2,3,4'},
                title: function(){return pro.name+' ( Construction Site )- Accounts Report'}
            },
            {
                extend: 'print',
                exportOptions:{columns: '0,1,2,3,4'},
                title: function(){return pro.name+' ( Construction Site )- Accounts Report'}
            },
        ]
    });

    jQuery.ajax({
        type : "GET",
        url : baseUrl+"transactions/balance/"+siteID,
        success:function(response){
            var data = JSON.parse(response);
            if(data.status === "success"){
                $("#accounts-report").html(data.message);
            }else{
                $("#accounts-report").html(data.message);
            }
        }
    });
});
//end after clicking Accounts

//after clicking Accounts
$("[href=\"#construction-site-documents\"]").click(function(){
    window.siteDocumentsTable = $("#siteDocumentsTable").dataTable({
        ajax : baseUrl+'documents/documents_table/'+siteID,
        destroy: true,
        paging: false,
    });
});
//end after clicking Accounts

//after clicking Employees
$("[href=\"#construction-site-employee\"]").click(function(){
    window.siteemployeesTable = $("#siteemployeesTable").dataTable({
        ajax : baseUrl+'employees/site_employee_table/'+siteID,
        dom: 'Bfrtip',
        destroy: true,
        buttons: [
            {
                extend: 'pdfHtml5',
                exportOptions:{columns: '0,1,2,3,5'},
                title: function(){return pro.name+'( Construction Site ) - Employee List'}
            },
            {
                extend: 'excelHtml5',
                exportOptions:{columns: '0,1,2,3,5'},
                title: function(){return pro.name+'( Construction Site ) - Employee List'}
            },
            {
                extend: 'print',
                exportOptions:{columns: '0,1,2,3,5'},
                title: function(){return pro.name+'( Construction Site ) - Employee List'}
            },
        ]
    });
});
//end after clicking Employees


$("#back").click(function(){
    $("#site-table-view").slideDown();
    $("button[data-target=\"#addingModal\"]").show();
    $("#back").hide();
    if($("#construction-site-view").is(":visible")){
        $("#construction-site-view").slideUp();
        $("[href=\"#engineer-profile\"]").click();
    }else if($("#supply-site-view").is(":visible")){
        $("#supply-site-view").slideUp();
    }
});