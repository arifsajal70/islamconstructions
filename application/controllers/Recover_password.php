<?php defined('BASEPATH') or exit('No DIrect script access allowed');
/**
 * @property CI_Form_validation $form_validation
 */

class Recover_password extends Signin_Controller{

	public function index($reset_key=NULL){
		$this->session->userdata('loggedin') == FALSE || redirect('dashboard');
		$data['reset_key'] = $reset_key;
		$this->load->view('recover_password',$data);
	}

	public function set_password(){
		$this->form_validation->set_rules('password','Password','trim|xss_clean|required');
		$this->form_validation->set_rules('cpassword','Confirm Password','trim|xss_clean|required|matches[password]');
		$this->form_validation->set_rules('reset_key','Reset Key','trim|xss_clean|callback_check_reset_key');
		if($this->form_validation->run() == FALSE){
			echo json_encode(array('status'=>'validation_error','message'=>validation_errors()));
		}else{
			$password = $this->hash($this->input->post('password'));
			$key = $this->hash($this->input->post('reset_key'));
			$this->load->database();
			$reset_key = $this->input->post('reset_key');
			if($reset_key){
				$tables = array('admins'=>'admins','engineers'=>'engineers','managers'=>'managers');
				foreach($tables as $table){
					$this->db->select('*');
					$this->db->from($table);
					$this->db->where('pass_reset_key',$reset_key);
					$user = $this->db->get();
					if($user->num_rows() > 0){
						$userdata = $user->row();
						$table_name = $table;
						break;
					}else{
						$userdata = FALSE;
					}
				}
			}
			if($userdata){
				$this->cm->table_name = $table_name;
				$this->cm->where = array('ID'=>$userdata->ID);
				if($this->cm->update(array('password'=>$password,'pass_reset_key'=>''))){
					echo json_encode(array('status'=>'success','message'=>'Password Changed Successfully'));
				}else{
					echo json_encode(array('status'=>'error','message'=>'Can\'t Change Password, Please Try Again'));
				}

			}
		}
	}

	public function check_reset_key(){
		$this->load->database();
		$reset_key = $this->input->post('reset_key');
		if($reset_key){
			$tables = array('admins'=>'admins','engineers'=>'engineers','managers'=>'managers');
			foreach($tables as $table){
				$this->db->select('*');
				$this->db->from($table);
				$this->db->where('pass_reset_key',$reset_key);
				$user = $this->db->get();
				if($user->num_rows() > 0){
					$userdata = $user->row();
					break;
				}else{
					$userdata = FALSE;
				}
			}
		}
		if($userdata){
			return TRUE;
		}else{
			$this->form_validation->set_message('check_reset_key','Password Reset Key Expired');
			return FALSE;
		}
	}

	protected function hash($string){
		return hash("sha512", $string . config_item("encryption_key"));
	}

}
