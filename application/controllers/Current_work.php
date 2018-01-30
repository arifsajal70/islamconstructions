<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Current_work extends MY_Controller{

	public function work_table($siteID){
		$this->cm->table_name = "currentwork";
		$this->cm->where = array('siteID'=>$siteID);
		$works = $this->cm->get();
		if($works->num_rows() > 0){
			$n=1;
			foreach($works->result() as $work){
				$result = array();
				$result[] = $n++;
				$result[] = $work->vehicle;
				$result[] = $work->vehicle_name;
				$result[] = $work->vehicle_number;
				$result[] = current_status_button($work->current_status);
				if($this->session->usertype == "Admin"):
				$result[] = current_work_status_change(base_url('current_work/status_change/'.$work->ID))." ".delete_button(base_url('current_work/delete/'.$work->ID));
				elseif($this->session->usertype == "Site Manager" || $this->session->usertype == "Manager"):
				$result[] = current_work_status_change(base_url('current_work/status_change/'.$work->ID));
				endif;
				$table['data'][] = $result;
			}
			echo json_encode($table);
		}else{
			echo '{
				"sEcho": 1,
				"iTotalRecords": "0",
				"iTotalDisplayRecords": "0",
				"aaData": []
			}';
		}
	}

	public function add($siteID){
		$this->check_site_status($siteID);
		$this->form_validation->set_rules('vehicle','Vehicle','trim|xss_clean|required');
		$this->form_validation->set_rules('vehicle_name','Vehicle Name','trim|xss_clean');
		$this->form_validation->set_rules('vehicle_number','Vehicle Number','trim|xss_clean');
		$this->form_validation->set_rules('current_status','Current Status','trim|xss_clean|required');
		if($this->form_validation->run() == FALSE){
			$this->send_warning(validation_errors());
		}else{
			$post_data = $this->array_from_post(array('vehicle','vehicle_name','vehicle_number','current_status'));
			$insert_data = array(
				'siteID' => $siteID,
				'vehicle' => $post_data['vehicle'],
				'vehicle_name' => $post_data['vehicle_name'],
				'vehicle_number' => $post_data['vehicle_number'],
				'current_status' => $post_data['current_status'],
			);
			$this->cm->reset_query();
			$this->cm->table_name = "currentwork";
			if($this->cm->insert($insert_data)){
				$this->send_success('Current Work Added Successfully');
			}else{
				$this->send_error('Can\'t Add Current Work, Please Try Again');
			}
		}
	}

	public function status_change($ID){
		$this->cm->table_name = "currentwork";
		$this->cm->where = array('ID'=>$ID);
		$work = $this->cm->get()->row();
		$this->check_site_status($work->siteID);
		$this->cm->reset_query();

		$this->form_validation->set_rules('status','Status','trim|xss_clean|required');
		if($this->form_validation->run() == FALSE){
			$this->send_warning(validation_errors());
		}else{
			$post_data = $this->array_from_post(array('status'));
			$this->cm->table_name = "currentwork";
			$this->cm->where = array('ID'=>$ID);
			if($this->cm->update(array('current_status'=>$post_data['status']))){
				$this->send_success('Status Updated Successfully');
			}else{
				$this->send_error('Can\'t Update Status Now, Please Try Again');
			}
		}
	}

	public function delete($ID){
		$this->cm->table_name = "currentwork";
		$this->cm->where = array('ID'=>$ID);
		$work = $this->cm->get()->row();
		$this->check_site_status($work->siteID);
		$this->cm->reset_query();

		$this->cm->table_name = "currentwork";
		$this->cm->where = array('ID'=>$ID);
		if($this->cm->delete()){
			$this->send_success('Current Work Deleted Successfully');
		}else{
			$this->send_error('Can\'t Delete Current Work, Please Try Again');
		}
	}

}
