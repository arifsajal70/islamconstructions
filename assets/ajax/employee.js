$(document).ready(function() {
    window.employeesTable = $("#employeesTable").dataTable({
        ajax : baseUrl+'employees/employee_table',
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                exportOptions:{columns: '0,1,2,3,5'},
                title: function(){return 'Islam Constructions - Employees'}
            },
            {
                extend: 'excelHtml5',
                exportOptions:{columns: '0,1,2,3,5'},
                title: function(){return 'Islam Constructions - Employees'}
            },
            {
                extend: 'print',
                exportOptions:{columns: '0,1,2,3,5'},
                title: function(){return 'Islam Constructions - Employees'}
            },
        ]
    });
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
                $("#editForm select[name=usertype]").val(data.usertype);
                $("#editForm").attr('action',baseUrl+'employees/edit/'+data.ID);
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
                    $("[for='document']").attr('onclick','download("employees","'+pro.ID+'")');

                    //set engineer ID for Generating Salary
                    $("#employee_salary_generation").attr('action',baseUrl+'salary/generate_employee_salary/'+pro.ID);

                    //setting working history table
                    window.workHistoryTable = $("#workHistoryTable").dataTable({
                        ajax : baseUrl+'employees/working_history/'+pro.ID,
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'pdfHtml5',
                                title: function(){return pro.name+' ( Manager ) - Working History'}
                            },
                            {
                                extend: 'excelHtml5',
                                title: function(){return pro.name+' ( Manager ) - Working History'}
                            },
                            {
                                extend: 'print',
                                title: function(){return pro.name+' ( Manager ) - Working History'}
                            },
                        ],
                        destroy: true,
                    });

                    //setting Salary table
                    window.salaryTable = $("#salaryTable").dataTable({
                        ajax : baseUrl+'employees/salary_table/'+pro.ID,
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'pdfHtml5',
                                exportOptions:{columns: '0,1,2,3'},
                                title: function(){return pro.name+' ( Manager ) - Salary Statement'}
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions:{columns: '0,1,2,3'},
                                title: function(){return pro.name+' ( Manager ) - Salary Statement'}
                            },
                            {
                                extend: 'print',
                                exportOptions:{columns: '0,1,2,3'},
                                title: function(){return pro.name+' ( Manager ) - Salary Statement'}
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