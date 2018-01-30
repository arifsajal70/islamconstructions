<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Dashboard extends MY_Controller{

    public function index(){
        $data['loader'] = $this->load(array(
                'datatables',
                'customjs'=> array(
                    base_url('assets/ajax/main.js'),
                )
            )
        );
        $data['page_title'] = "Dashboard";
        $data['subview'] = "dashboard";
        $this->load->view('mainView',$data);
    }

}