$(document).ready(function() {
    window.adminsTable = $("#adminsTable").dataTable({
        ajax : baseUrl+'admins/admin_table',
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
                $("#editForm input[name=email]").val(data.email);
                $("#editForm input[name=phone]").val(data.phone);
                $("#editForm textarea[name=address]").val(data.address);
                $("#editForm input[name=join_date]").val(data.join_date);
                $("#editForm input[name=salary]").val(data.salary);
                $("#editForm input[name=username]").val(data.username);
                $("#editForm").attr('action',baseUrl+'admins/edit/'+data.ID);
            }
        }
    });
}

function view(url){
    if($("#admin-table-view").is(":visible")){
        $("#admin-table-view").slideUp();
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
                    console.log(pro);
                    $("#profile-image").attr('src',baseUrl+'uploads/'+pro.photo);
                    $("#profile-name").html(pro.name);
                    $("#profile-email").html(pro.email);
                    $("#profile-call-now").attr('href',"tel:"+pro.phone);
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
    $("#admin-table-view").slideDown();
    $("button[data-target=\"#addingModal\"]").show();
    $("#back").hide();
    $("#profile-view").slideUp();
});