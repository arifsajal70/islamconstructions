$(document).ready(function() {
    window.sitesTable = $("#sitesTable").dataTable({
        ajax : baseUrl+'sites/supply_site_table',
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                exportOptions:{columns: '0,1,2,3'},
                title: function(){return 'Islam Constructions - Supply Sites'}
            },
            {
                extend: 'excelHtml5',
                exportOptions:{columns: '0,1,2,3'},
                title: function(){return 'Islam Constructions - Supply Sites'}
            },
            {
                extend: 'print',
                exportOptions:{columns: '0,1,2,3'},
                title: function(){return 'Islam Constructions - Supply Sites'}
            },
        ]
    });

    $("#back").click(function(){
        $("#site-table-view").slideDown();
        $("button[data-target=\"#addingModal\"]").show();
        $("#back").hide();
        if($("#construction-site-view").is(":visible")){
            $("#construction-site-view").slideUp();
            $("[href=\"#engineer-profile\"]").click();
        }else if($("#supply-site-view").is(":visible")){
            $("#supply-site-view").slideUp();
            $("[href=\"#supply-site-bills\"]").click();
        }
    });

    //after clicking Payments
    $("[href=\"#supply-site-payments\"]").click(function(){
        window.sitePaymentsTable = $("#sitePaymentsTable").dataTable({
            ajax : baseUrl+'payments/payments_table/'+siteID,
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
            url : baseUrl+"payments/payments_report/"+siteID,
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

    //after clicking Managers
    $("[href=\"#supply-site-managers\"]").click(function(){
        window.siteManagersTable = $("#siteManagersTable").dataTable({
            ajax : baseUrl+'managers/site_managers/'+siteID,
            dom: 'Bfrtip',
            destroy: true,
            buttons: [
                {
                    extend: 'pdfHtml5',
                    exportOptions:{columns: '0,1,2,3,4'},
                    title: function(){return pro.name+' ( Supply Site ) - Managers'}
                },
                {
                    extend: 'excelHtml5',
                    exportOptions:{columns: '0,1,2,3,4'},
                    title: function(){return pro.name+' ( Supply Site ) - Managers'}
                },
                {
                    extend: 'print',
                    exportOptions:{columns: '0,1,2,3,4'},
                    title: function(){return pro.name+' ( Supply Site ) - Managers'}
                },
            ]
        });
    });
    //end after clicking Managers

    //after clicking Managers
    $("[href=\"#supply-site-current-works\"]").click(function(){
        window.currentWorksTable = $("#currentWorksTable").dataTable({
            ajax : baseUrl+'current_work/work_table/'+siteID,
            dom: 'Bfrtip',
            destroy: true,
            buttons: [
                {
                    extend: 'pdfHtml5',
                    exportOptions:{columns: '0,1,2,3,4'},
                    title: function(){return pro.name+' ( Supply Site ) - Managers'}
                },
                {
                    extend: 'excelHtml5',
                    exportOptions:{columns: '0,1,2,3,4'},
                    title: function(){return pro.name+' ( Supply Site ) - Managers'}
                },
                {
                    extend: 'print',
                    exportOptions:{columns: '0,1,2,3,4'},
                    title: function(){return pro.name+' ( Supply Site ) - Managers'}
                },
            ]
        });
    });
    //end after clicking Managers

});

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
                $("#editForm").attr('action',baseUrl+'sites/edit/'+data.ID);
            }
        }
    });
}

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
                    $("#billForm").attr('action',baseUrl+'bills/add/'+pro.ID);
                    $("#paymentForm").attr('action',baseUrl+'payments/add/'+pro.ID);
                    $("#addManagerForm").attr('action',baseUrl+'managers/add_manager_to_site/'+pro.ID);
                    $("#addCurrentWorkForm").attr('action',baseUrl+'current_work/add/'+pro.ID);

                    //Loading All Billings
                    window.siteBillsTable = $("#siteBillsTable").dataTable({
                        ajax : baseUrl+'bills/bills_table/'+siteID,
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

function change_current_status(url){
	$("[data-target=\"#currentStatusChange\"]").click();
	$("#currentStatusChangeForm").attr('action',url);
}
