<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Profile extends MY_Controller{

	public function index(){
		$data['loader'] = $this->load(array(
				'datatables',
				'upload',
				'alert',
				'datepicker',
				'select2',
				'customjs'=> array(
					base_url('assets/ajax/main.js'),
					base_url('assets/ajax/profile.js')),
			)
		);
		$data['profile'] = $this->get_profile();
		$data['page_title'] = "Profile";
		$data['subview'] = "profile";
		$this->load->view('mainView',$data);
	}

	public function update_profile(){
		$profile = $this->get_profile();
		$this->form_validation->set_rules('name','Name','trim|xss_clean|required');
		$this->form_validation->set_rules('phone','Phone','trim|xss_clean|required');
		$this->form_validation->set_rules('address','Address','trim|xss_clean|required');
		$this->form_validation->set_rules('username','Username','trim|xss_clean|required');
		if($this->form_validation->run() == FALSE){
			$this->send_warning(validation_errors());
		}else{
			$post_data = $this->array_from_post(array('name','phone','address','username'));
			if($_FILES){
				foreach($_FILES as $key => $value){
					$upload = $this->cm->upload($key,'./uploads/');
					if($upload['status'] == 'success'){
						$this->cm->delete_file('./uploads/'.$profile->$key);
						$filenames[$key] = $upload['file_name'];
					}
				}
			}
			$array = array(
				'name' => $post_data['name'],
				'phone' => $post_data['phone'],
				'address' => $post_data['address'],
				'username' => $post_data['username'],
				'photo' => isset($filenames['photo']) ? $filenames['photo'] : $profile->photo,
			);
			$this->cm->table_name = $this->get_user_table();
			$this->cm->where = array('ID'=>$profile->ID);
			if($this->cm->update($array)){
				$this->send_success("Profile Updated Successfully");
			}else{
				$this->send_error('Can\'t Update Profile. Please Try Again');
			}
		}
	}

	public function change_password(){
		$profile = $this->get_profile();
		$this->form_validation->set_rules('current_password','Current Password','trim|xss_clean|required|callback_password_checker');
		$this->form_validation->set_rules('new_password','New Password','trim|xss_clean|required');
		$this->form_validation->set_rules('confirm_password','Confirm Password','matches[new_password]');
		if($this->form_validation->run() == FALSE){
			$this->send_warning(validation_errors());
		}else{
			$post_data = $this->array_from_post(array('new_password'));
			$this->cm->table_name = $this->get_user_table();
			$this->cm->where = array('ID'=>$profile->ID);
			if($this->cm->update(array('password'=>$this->hash($post_data['new_password'])))){
				$this->send_success('Password Changed Successfully');
			}else{
				$this->send_error('Can\'t Change Password Now, Please Try Again');
			}
		}
	}

	public function get_profile(){
		$table = $this->get_user_table();
		$this->cm->table_name = $table;
		$this->cm->where = array('ID'=>$this->session->userdata('ID'));
		$user = $this->cm->get()->row();
		$array = array(
			'ID' => $user->ID,
			'name' => $user->name,
			'email' => $user->email,
			'phone' => $user->phone,
			'address' => $user->address,
			'join_date' => $user->join_date,
			'salary' => $user->salary,
			'photo' => $user->photo,
			'username' => $user->username,
			'usertype' => $user->usertype,
		);
		return json_decode(json_encode($array));
	}

	public function get_user_table(){
		$usertype = $this->session->userdata('usertype');
		$table = NULL;
		switch ($usertype){
			case "Admin";
				$table = "admins";
				break;
			case "Engineer";
				$table = "engineers";
				break;
			case "Manager" || "Site Manager";
				$table = "managers";
				break;
		}
		return $table;
	}

	public function password_checker(){
		$password = $this->input->post('current_password');
		$profile = $this->get_profile();
		$this->cm->table_name = $this->get_user_table();
		$this->cm->where = array('ID'=>$profile->ID,'password'=>$this->hash($password));
		$return = $this->cm->get();
		if($return->num_rows() > 0){
			return TRUE;
		}else{
			$this->form_validation->set_message('password_checker','Current Password Is Wrong');
			return false;
		}
	}

}
