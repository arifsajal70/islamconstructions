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

function media_button($ajax_call,$id){
    return "<button type=\"button\" class=\"btn bg-instagram btn-sm\" onclick=\"$ajax_call('$id')\"><span class=\"fa fa-image\"></span></button>";
}

function discount_button($ajax_call,$id){
    return "<button type=\"button\" class=\"btn bg-dribbble btn-sm\" onclick=\"$ajax_call('$id')\"><span class=\"fa fa-calculator\"></span></button>";
}

function review_button($ajax_call,$id){
    return "<button type=\"button\" class=\"btn bg-tumblr btn-sm\" onclick=\"$ajax_call('$id')\"><span class=\"fa fa-globe\"></span></button>";
}

function add_button($ajax_call,$id){
    return "<button type=\"button\" class=\"btn btn-success btn-sm\" onclick=\"$ajax_call('$id')\"><span class=\"fa fa-plus\"></span></button>";
}

function pass_change_button($url){
    return "<button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Change Password\"  onclick=\"password_change('$url')\"><span class=\"fa fa-lock\"></span></button>";
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

function payment_status($status,$url){
    if($status == (int) 1){
        return "<button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Change Status To Unpaid\" onclick=\"switchStatus('$url')\">Paid</button>";
    }
    else{
        return "<button type=\"button\" class=\"btn btn-danger btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Change Status To Paid\" onclick=\"switchStatus('$url')\">Unpaid</button>";
    }
}

function featured_button($ajax_call,$id,$status){
    if($status == 1){
        return "<button type=\"button\" class=\"btn btn-success btn-sm\" onclick=\"$ajax_call('$id','$status')\">Featured</button>";
    }
    else{
        return "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"$ajax_call('$id','$status')\">Not Featured</button>";
    }
}