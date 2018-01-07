<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Login extends Signin_Controller{

    public function index(){
        $this->session->userdata('loggedin') == FALSE || redirect('dashboard');
        $this->load->view('login');
    }

}