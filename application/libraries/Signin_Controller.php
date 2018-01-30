<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Signin_Controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Crud_Model','cm');
    }

}
