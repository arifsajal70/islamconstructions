<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Dashboard extends MY_Controller{

    public function index(){
        $data['page_title'] = "Dashboard";
        $data['subview'] = "dashboard";
        $this->load->view('mainView',$data);
    }

}