window.engineersTable = $("#engineersTable").dataTable({
    ajax : baseUrl+'engineers/engineer_table',
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'pdfHtml5',
            exportOptions:{columns: '0,1,2,3,5'},
            title: function(){return 'Islam Constructions - Engineers'}
        },
        {
            extend: 'excelHtml5',
            exportOptions:{columns: '0,1,2,3,5'},
            title: function(){return 'Islam Constructions - Engineers'}
        },
        {
            extend: 'print',
            exportOptions:{columns: '0,1,2,3,5'},
            title: function(){return 'Islam Constructions - Engineers'}
        },
    ]
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
                $("#editForm input[name=email]").val(data.email);
                $("#editForm input[name=phone]").val(data.phone);
                $("#editForm textarea[name=address]").val(data.address);
                $("#editForm input[name=join_date]").val(data.join_date);
                $("#editForm input[name=salary]").val(data.salary);
                $("#editForm input[name=username]").val(data.username);
                $("#editForm").attr('action',baseUrl+'engineers/edit/'+data.ID);
            }else{
                alert('No Engineer Found');
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
                    var pro = JSON.parse(data.message)[0];
                    $("#profile-image").attr('src',baseUrl+'uploads/'+pro.photo);
                    $("#profile-name").html(pro.name);
                    $("#profile-email").html(pro.email);
                    $("#profile-call-now").attr('href',"tel:"+pro.phone);

                    //setting profile Information
                    $("[for='name']").html(pro.name);
                    $("[for='email']").html(pro.email);
                    $("[for='phone']").html(pro.phone);
                    $("[for='address']").html(pro.address);
                    $("[for='join_date']").html(pro.join_date);
                    $("[for='salary']").html(pro.salary);
                    $("[for='username']").html(pro.username);
                    $("[for='document']").attr('onclick','download("engineers","'+pro.ID+'")');

                    //set engineer ID for Generating Salary
                    $("#engineer_salary_generation").attr('action',baseUrl+'salary/generate_engineer_salary/'+pro.ID);

                    //setting working history table
                    window.workHistoryTable = $("#workHistoryTable").dataTable({
                        ajax : baseUrl+'engineers/working_history/'+pro.ID,
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'pdfHtml5',
                                title: function(){return pro.name+'( Eng ) - Working History'}
                            },
                            {
                                extend: 'excelHtml5',
                                title: function(){return pro.name+'( Eng ) - Working History'}
                            },
                            {
                                extend: 'print',
                                title: function(){return pro.name+'( Eng ) - Working History'}
                            },
                        ],
                        destroy: true,
                    });

                    //setting Salary table
                    window.salaryTable = $("#salaryTable").dataTable({
                        ajax : baseUrl+'engineers/salary_table/'+pro.ID,
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'pdfHtml5',
                                exportOptions:{columns: '0,1,2,3'},
                                title: function(){return pro.name+'( Eng ) - Salary Statement'}
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions:{columns: '0,1,2,3'},
                                title: function(){return pro.name+'( Eng ) - Salary Statement'}
                            },
                            {
                                extend: 'print',
                                exportOptions:{columns: '0,1,2,3'},
                                title: function(){return pro.name+'( Eng ) - Salary Statement'}
                            },
                        ],
                        destroy: true,
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

$("#back").click(function(){
    $("#eng-table-view").slideDown();
    $("button[data-target=\"#addingModal\"]").show();
    $("#back").hide();
    $("[href=\"#profile\"]").click();
    $("#profile-view").slideUp();
});