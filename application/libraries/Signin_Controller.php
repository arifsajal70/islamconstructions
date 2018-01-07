<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Signin_Controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

}