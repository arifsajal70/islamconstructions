$(document).ready(function() {
    window.itemsTable = $("#itemsTable").dataTable({
        ajax : baseUrl+'items/item_table',
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
                $("#editForm input[name=name]").val(data.name);
                $("#editForm input[name=unit]").val(data.unit);
                $("#editForm input[name=price]").val(data.price);
                $("#editForm").attr('action',baseUrl+'items/edit/'+data.ID);
            }
        }
    });
}