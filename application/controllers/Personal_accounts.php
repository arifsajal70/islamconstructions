<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Personal_accounts extends MY_Controller{

	public function index(){
		$data['loader'] = $this->load(array(
				'datatables',
				'upload',
				'alert',
				'datepicker',
				'select2',
				'customjs'=> array(
					base_url('assets/vendor/highcharts/js/highcharts.js'),
					base_url('assets/ajax/main.js'),
					base_url('assets/ajax/personal_accounts.js')),
				'customcss' => array(
					base_url('assets/vendor/highcharts/css/highcharts.css'),
				),
			)
		);
		$data['page_title'] = "Personal Accounts";
		$data['subview'] = "personal_accounts";
		$this->load->view('mainView',$data);
	}

	public function add_balance_table(){
		$this->cm->table_name = "personal_balance";
		$balance = $this->cm->get();
		if($balance->num_rows() > 0){
			$n=1;
			foreach($balance->result() as $bal){
				$result = array();
				$result[] = $n++;
				$result[] = $bal->title;
				$result[] = $bal->date;
				$result[] = $bal->note;
				$result[] = $bal->amount;
				$result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"personal_balance\",\"".$bal->ID."\")'><i class=\"ti-download\"></i> Download</button>";
				$result[] = edit_button(base_url('personal_accounts/single_balance/'.$bal->ID))." ".delete_button(base_url('personal_accounts/delete_balance/'.$bal->ID));
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

	public function expense_table(){
		$this->cm->table_name = "personal_expense";
		$balance = $this->cm->get();
		if($balance->num_rows() > 0){
			$n=1;
			foreach($balance->result() as $bal){
				$result = array();
				$result[] = $n++;
				$result[] = $bal->title;
				$result[] = $bal->date;
				$result[] = $bal->note;
				$result[] = $bal->amount;
				$result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"personal_expense\",\"".$bal->ID."\")'><i class=\"ti-download\"></i> Download</button>";
				$result[] = edit_button(base_url('personal_accounts/single_expense/'.$bal->ID))." ".delete_button(base_url('personal_accounts/delete_expense/'.$bal->ID));
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

	public function add_balance(){
		$this->form_validation->set_rules('title','Title','trim|xss_clean|required');
		$this->form_validation->set_rules('amount','Amount','trim|xss_clean|required');
		$this->form_validation->set_rules('note','Note','trim|xss_clean');
		$this->form_validation->set_rules('date','Date','trim|xss_clean|required');
		if($this->form_validation->run() == FALSE){
			$this->send_warning(validation_errors());
		}else{
			$post_data = $this->array_from_post(array('title','amount','note','date'));
			if($_FILES){
				foreach($_FILES as $key => $value){
					$upload = $this->cm->upload($key,'./uploads/');
					if($upload['status'] == 'success'){
						$filenames[$key] = $upload['file_name'];
					}else{
						$filenames[$key] = $upload['error'];
					}
				}
			}
			$insert_array = array(
				'title' => $post_data['title'],
				'amount' => $post_data['amount'],
				'note' => $post_data['note'],
				'date' => $post_data['date'],
				'filename' =>$_FILES['document']['name'] ? $_FILES['document']['name'] : "No File Selected",
				'document' => isset($filenames['document']) ? $filenames['document'] : "No File Selected",
			);
			$this->cm->table_name = "personal_balance";
			if($this->cm->insert($insert_array)){
				$this->send_success('Add Balance Added Successfully');
			}else{
				$this->send_error('Can\'t Add Balance, Please Try Again');
			}
		}
	}

	public function add_expense(){
		$this->form_validation->set_rules('title','Title','trim|xss_clean|required');
		$this->form_validation->set_rules('amount','Amount','trim|xss_clean|required');
		$this->form_validation->set_rules('note','Note','trim|xss_clean');
		$this->form_validation->set_rules('date','Date','trim|xss_clean|required');
		if($this->form_validation->run() == FALSE){
			$this->send_warning(validation_errors());
		}else{
			$post_data = $this->array_from_post(array('title','amount','note','date'));
			if($_FILES){
				foreach($_FILES as $key => $value){
					$upload = $this->cm->upload($key,'./uploads/');
					if($upload['status'] == 'success'){
						$filenames[$key] = $upload['file_name'];
					}else{
						$filenames[$key] = $upload['error'];
					}
				}
			}
			$insert_array = array(
				'title' => $post_data['title'],
				'amount' => $post_data['amount'],
				'note' => $post_data['note'],
				'date' => $post_data['date'],
				'filename' =>$_FILES['document']['name'] ? $_FILES['document']['name'] : "No File Selected",
				'document' => isset($filenames['document']) ? $filenames['document'] : "No File Selected",
			);
			$this->cm->table_name = "personal_expense";
			if($this->cm->insert($insert_array)){
				$this->send_success('Expense Added Successfully');
			}else{
				$this->send_error('Can\'t Add Expense, Please Try Again');
			}
		}
	}

	public function single_balance($ID = NULL,$return_type = 'json'){
		if($ID != NULL){
			$this->cm->table_name = "personal_balance";
			$this->cm->field_name = "ID";
			$this->cm->primary_key = $ID;
			$employees = $this->cm->get();
			if($employees->num_rows() == (int) 1){
				foreach($employees->result() as $key => $value){
					$result[$key] = $value;
				}
				if($return_type == 'json'){
					$this->send_success(json_encode($result));
				}elseif($return_type == 'array'){
					return json_decode(json_encode($result[0]));
				}else{
					$this->send_error('Invalid Return Type Passed');
				}
			}else{
				$this->send_error('Nothing Regarding This ID');
			}
		}else{
			$this->send_error('No Argument Passed');
		}
	}

	public function single_expense($ID = NULL,$return_type = 'json'){
		if($ID != NULL){
			$this->cm->table_name = "personal_expense";
			$this->cm->field_name = "ID";
			$this->cm->primary_key = $ID;
			$employees = $this->cm->get();
			if($employees->num_rows() == (int) 1){
				foreach($employees->result() as $key => $value){
					$result[$key] = $value;
				}
				if($return_type == 'json'){
					$this->send_success(json_encode($result));
				}elseif($return_type == 'array'){
					return json_decode(json_encode($result[0]));
				}else{
					$this->send_error('Invalid Return Type Passed');
				}
			}else{
				$this->send_error('Nothing Regarding This ID');
			}
		}else{
			$this->send_error('No Argument Passed');
		}
	}

	public function edit_balance($ID){
		$bal = $this->single_balance($ID,'array');
		$this->form_validation->set_rules('title','Title','trim|xss_clean|required');
		$this->form_validation->set_rules('amount','Amount','trim|xss_clean|required');
		$this->form_validation->set_rules('note','Note','trim|xss_clean');
		$this->form_validation->set_rules('date','Date','trim|xss_clean|required');
		if($this->form_validation->run() == FALSE){
			$this->send_warning(validation_errors());
		}else{
			$post_data = $this->array_from_post(array('title','amount','note','date'));
			if($_FILES){
				foreach($_FILES as $key => $value){
					$upload = $this->cm->upload($key,'./uploads/');
					if($upload['status'] == 'success'){
						$this->cm->delete_file('./uploads/'.$bal->$key);
						$filenames[$key] = $upload['file_name'];
					}
				}
			}
			$update_array = array(
				'title' => $post_data['title'],
				'amount' => $post_data['amount'],
				'note' => $post_data['note'],
				'date' => $post_data['date'],
				'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : $bal->filename,
				'document' => isset($filenames['document']) ? $filenames['document'] : $bal->document,
			);
			$this->cm->table_name = "personal_balance";
			$this->cm->where = array('ID'=>$ID);
			if($this->cm->update($update_array)){
				$this->send_success('Balance Edited Successfully');
			}else{
				$this->send_error('Can\'t Edit Balance, Please Try Again');
			}
		}
	}

	public function edit_expense($ID){
		$bal = $this->single_expense($ID,'array');
		$this->form_validation->set_rules('title','Title','trim|xss_clean|required');
		$this->form_validation->set_rules('amount','Amount','trim|xss_clean|required');
		$this->form_validation->set_rules('note','Note','trim|xss_clean');
		$this->form_validation->set_rules('date','Date','trim|xss_clean|required');
		if($this->form_validation->run() == FALSE){
			$this->send_warning(validation_errors());
		}else{
			$post_data = $this->array_from_post(array('title','amount','note','date'));
			if($_FILES){
				foreach($_FILES as $key => $value){
					$upload = $this->cm->upload($key,'./uploads/');
					if($upload['status'] == 'success'){
						$this->cm->delete_file('./uploads/'.$bal->$key);
						$filenames[$key] = $upload['file_name'];
					}
				}
			}
			$update_array = array(
				'title' => $post_data['title'],
				'amount' => $post_data['amount'],
				'note' => $post_data['note'],
				'date' => $post_data['date'],
				'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : $bal->filename,
				'document' => isset($filenames['document']) ? $filenames['document'] : $bal->document,
			);
			$this->cm->table_name = "personal_expense";
			$this->cm->where = array('ID'=>$ID);
			if($this->cm->update($update_array)){
				$this->send_success('Expense Edited Successfully');
			}else{
				$this->send_error('Can\'t Edit Expense, Please Try Again');
			}
		}
	}

	public function report(){
		$this->cm->select_sum = "amount";
		$this->cm->select = "DATE_FORMAT(date,'%m') as month";
		$this->cm->table_name = "personal_balance";
		$this->cm->where = array("DATE_FORMAT(date,'%Y')" => date('Y'));
		$this->cm->group_by = "DATE_FORMAT(date,'%m')";
		$balance = $this->cm->get();
		//print_r($balance_sheet);exit;
		if($balance->num_rows() > 0){
			foreach($balance->result() as $bal){
				$balance_sheet[intval($bal->month)] = $bal->amount;
			}
			$month = array(1,2,3,4,5,6,7,8,9,10,11,12);
			foreach($month as $mon){
				$balances[] = array_key_exists($mon,$balance_sheet) ? (int) $balance_sheet[$mon] : 0 ;
			}
		}else{
			$balances = array(0,0,0,0,0,0,0,0,0,0,0,0);
		}

		$reports['balance'] = $balances;

		$this->cm->reset_query();
		$this->cm->select_sum = "amount";
		$this->cm->select = "DATE_FORMAT(date,'%m') as month";
		$this->cm->table_name = "personal_expense";
		$this->cm->where = array("DATE_FORMAT(date,'%Y')" => date('Y'));
		$this->cm->group_by = "DATE_FORMAT(date,'%m')";
		$expense = $this->cm->get();
		//print_r($balance_sheet);exit;
		if($expense->num_rows() > 0){
			foreach($expense->result() as $exp){
				$expense_sheet[intval($exp->month)] = $exp->amount;
			}
			$month = array(1,2,3,4,5,6,7,8,9,10,11,12);
			foreach($month as $mon){
				$expenses[] = array_key_exists($mon,$expense_sheet) ? (int) $expense_sheet[$mon] : 0 ;
			}
		}else{
			$expenses = array(0,0,0,0,0,0,0,0,0,0,0,0);
		}
		$reports['expense'] = $expenses;
		$reports['status'] = "success";

		echo json_encode($reports);
	}

	public function delete_balance($ID){
		$this->cm->reset_query();
		$this->cm->table_name = "personal_balance";
		$this->cm->where = array('ID'=>$ID);
		$bal = $this->cm->get();
		if($this->cm->delete_file('./uploads/'.$bal->row()->document) && $this->cm->delete()){
			$this->send_success('Balance Record Deleted Successgully');
		}else{
			$this->send_error('Can\'t Delete Balance Record Now, Please Try Again');
		}
	}

	public function delete_expense($ID){
		$this->cm->reset_query();
		$this->cm->table_name = "personal_expense";
		$this->cm->where = array('ID'=>$ID);
		$exp = $this->cm->get();
		if($this->cm->delete_file('./uploads/'.$exp->row()->document) && $this->cm->delete()){
			$this->send_success('Expense Record Deleted Successgully');
		}else{
			$this->send_error('Can\'t Delete Expense Record Now, Please Try Again');
		}
	}

}




























