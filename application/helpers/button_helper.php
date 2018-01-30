<?php defined('BASEPATH') or exit('No DIrect script access allowed');

function delete_button($url){
    return "<button type=\"button\" class=\"btn btn-danger btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\" onclick=\"deleteElelm('$url')\"><span class=\"fa fa-trash\"></span></button>";
}

function edit_button($url){
    return "<button type=\"button\" class=\"btn btn-primary btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\" onclick=\"edit('$url')\"><span class=\"fa fa-edit\"></span></button>";
}

function view_button($url){
    return "<button type=\"button\" class=\"btn btn-purple btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"View\" onclick=\"view('$url')\"><span class=\"fa fa-eye\"></span></button>";
}

function pass_change_button($url){
    return "<button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Change Password\"  onclick=\"password_change('$url')\"><span class=\"fa fa-lock\"></span></button>";
}

function current_work_status_change($url){
    return "<button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Change Current Status\"  onclick=\"change_current_status('$url')\"><span class=\"fa fa-exchange\"></span></button>";
}

function status_switch($status,$url){
    if($status == (int) 1){
        return "<button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Change Status To Deactive\" onclick=\"switchStatus('$url')\">Active</button>";
    }
    else{
        return "<button type=\"button\" class=\"btn btn-danger btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Change Status To Active\" onclick=\"switchStatus('$url')\">Deactive</button>";
    }
}

function status_button($status){
    if($status == (int) 1){
        return "<button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Site Active\" >Active</button>";
    }
    else{
        return "<button type=\"button\" class=\"btn btn-danger btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Site Closed\" >Deactive</button>";
    }
}

function current_status_button($status){
    if($status == "Not Arrived"){
        return "<button type=\"button\" class=\"btn btn-danger btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Not Arrived\" >".$status."</button>";
    }
    elseif($status == "Arrived"){
        return "<button type=\"button\" class=\"btn btn-warning btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Arrived\" >".$status."</button>";
    }
    elseif($status == "Unloading"){
        return "<button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Unloading\" >".$status."</button>";
    }
    elseif($status == "Unloaded"){
        return "<button type=\"button\" class=\"btn btn-purple btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Unloaded\" >".$status."</button>";
    }
    elseif($status == "Completed"){
        return "<button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Completed\" >".$status."</button>";
    }
}

function payment_status($status,$url){
    if($status == (int) 1){
        return "<button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Change Status To Unpaid\" onclick=\"switchStatus('$url')\">Paid</button>";
    }
    else{
        return "<button type=\"button\" class=\"btn btn-danger btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Change Status To Paid\" onclick=\"switchStatus('$url')\">Unpaid</button>";
    }
}
