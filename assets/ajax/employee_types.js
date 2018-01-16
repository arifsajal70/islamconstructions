$(document).ready(function(){
    window.employeeTypeTable = $("#employeeTypeTable").dataTable({
        ajax : baseUrl+'employee_types/employee_type_table',
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
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
                $("#editForm input[name=type]").val(data.usertype);
                $("#editForm textarea[name=note]").val(data.note);
                $("#editForm").attr('action',baseUrl+'employee_types/edit/'+data.ID);
            }
        }
    });
}