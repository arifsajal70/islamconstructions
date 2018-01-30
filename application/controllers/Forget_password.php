<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Forget_password extends Signin_Controller{

	public function index(){
		$this->session->userdata('loggedin') == FALSE || redirect('dashboard');
		$this->load->view('forget_password');
	}

	public function recover_password(){
		$this->form_validation->set_rules('username','Username Or Email','trim|xss_clean|required');
		if($this->form_validation->run() == FALSE){
			echo json_encode(array('status'=>'validation_error','message'=>validation_errors()));
		}else{
			$this->load->database();
			$username = $this->input->post('username');
			$tables = array('admins'=>'admins','engineers'=>'engineers','managers'=>'managers');
			foreach($tables as $table){
				$this->db->select('*');
				$this->db->from($table);
				$this->db->group_start();
				$this->db->where('username',$username);
				$this->db->or_where(array('email'=>$username,'phone'=>$username));
				$this->db->group_end();
				$user = $this->db->get();
				if($user->num_rows() > 0){
					$userdata = $user;
					$table_name = $table;
					break;
				}else{
					$userdata = FALSE;
				}
			}
			if($userdata->num_rows() > 0){
				$this->load->helper('string');
				$reset_key = time().random_string('alnum',64);
				$reset_link = "<a href='".base_url('recover_password/index/'.$reset_key)."'>Reset Password</a>";
				$send_mail = $this->cm->send_mail('info@islamconstructions.com',$userdata->row()->email,'Reset Password',$reset_link);
				$this->cm->table_name = $table_name;
				$this->cm->where = array('ID'=>$userdata->row()->ID);
				$update = $this->cm->update(array('pass_reset_key'=>$reset_key));
				if($send_mail && $update){
					echo json_encode(array('status'=>'success','message'=>'Check Your Mail For Password Reset Instructions'));
				}else{
					echo json_encode(array('status'=>'error','message'=>$send_mail));
				}
			}else{
				echo "Nothing Found";
			}
		}
	}
}
