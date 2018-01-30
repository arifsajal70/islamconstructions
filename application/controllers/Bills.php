<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Bills extends MY_Controller{

    public function bills_table($siteID){
    	$this->input->is_ajax_request() || exit('You Cant Access This Page Directly');
        $this->cm->select = 'bills.*,items.*,bills.ID as billID';
        $this->cm->table_name = "bills";
        $this->cm->join = array('items'=>'bills.itemID=items.ID');
        $this->cm->where = array('siteID'=>$siteID);
        $bills = $this->cm->get();
        if($bills->num_rows() > 0){
            $n=1;
            foreach($bills->result() as $bill){
                $result = array();
                $result[] = $n++;
                $result[] = $bill->title;
                $result[] = $bill->date;
                $result[] = $bill->name;
                $result[] = $bill->quantity;
                $result[] = $bill->rate;
                $result[] = $bill->quantity*$bill->rate;
                $result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"bills\",\"".$bill->billID."\")'><i class=\"ti-download\"></i> Download</button>";
                if($this->session->usertype == "Admin"):
                $result[] = delete_button(base_url('bills/delete/'.$bill->billID));
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

    public function supplier_bills_table($supplierID){
    	$this->input->is_ajax_request() || exit('You Cant Access This Page Directly');
        $this->cm->select = 'supplierbills.*,items.*,supplierbills.ID as billID';
        $this->cm->table_name = "supplierbills";
        $this->cm->join = array('items'=>'supplierbills.itemID=items.ID');
        $this->cm->where = array('supplierID'=>$supplierID);
        $bills = $this->cm->get();
        if($bills->num_rows() > 0){
            $n=1;
            foreach($bills->result() as $bill){
                $result = array();
                $result[] = $n++;
                $result[] = $bill->title;
                $result[] = $bill->date;
                $result[] = $bill->name;
                $result[] = $bill->quantity;
                $result[] = $bill->rate;
                $result[] = $bill->quantity*$bill->rate;
                $result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"bills\",\"".$bill->billID."\")'><i class=\"ti-download\"></i> Download</button>";
                if($this->session->usertype == "Admin"):
                $result[] = delete_button(base_url('bills/delete_from_supplier/'.$bill->billID));
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

    public function add($siteID=NULL){
    	$this->input->is_ajax_request() || exit('You Cant Access This Page Directly');
    	$this->session->usertype == "Admin" || $this->session->usertype == "Manager" || $this->session->usertype == "Site Manager" || exit('You Dont Have Permission To Do This');
        $this->form_validation->set_rules('title','Title','trim|xss_clean|required');
        $this->form_validation->set_rules('date','Date','trim|xss_clean|required');
        $this->form_validation->set_rules('itemID','Item','trim|xss_clean|required');
        $this->form_validation->set_rules('quantity','Quantity','trim|xss_clean|required');
        $this->form_validation->set_rules('rate','Rate Per Item','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('title','date','itemID','quantity','rate'));
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
            $insert_data = array(
                'siteID' => $siteID,
                'title' => $post_data['title'],
                'date' => $post_data['date'],
                'itemID' => $post_data['itemID'],
                'quantity' => $post_data['quantity'],
                'rate' => $post_data['rate'],
                'amount' => $post_data['quantity']*$post_data['rate'],
                'filename' => isset($_FILES['document']['name']) ? $_FILES['document']['name'] : "No File Selected",
                'document' => isset($filenames['document']) ? $filenames['document'] : "No File Selected",
            );
            $this->cm->table_name = "bills";
            if($this->cm->insert($insert_data)){
                $this->send_success('Bill Added Successfully');
            }else{
                $this->send_error('Can\'t Add Bill Now, Please Try Again');
            }
        }
    }

    public function add_for_supplier($managerID=NULL){
		$this->input->is_ajax_request() || exit('You Cant Access This Page Directly');
		$this->session->usertype == "Admin" || $this->session->usertype == "Manager" || exit('You dont Have Permission To Do This');
        $this->form_validation->set_rules('title','Title','trim|xss_clean|required');
        $this->form_validation->set_rules('date','Date','trim|xss_clean|required');
        $this->form_validation->set_rules('itemID','Item','trim|xss_clean|required');
        $this->form_validation->set_rules('quantity','Quantity','trim|xss_clean|required');
        $this->form_validation->set_rules('rate','Rate Per Item','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('title','date','itemID','quantity','rate'));
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
            $insert_data = array(
                'supplierID' => $managerID,
                'title' => $post_data['title'],
                'date' => $post_data['date'],
                'itemID' => $post_data['itemID'],
                'quantity' => $post_data['quantity'],
                'rate' => $post_data['rate'],
                'amount' => $post_data['quantity']*$post_data['rate'],
                'filename' => isset($_FILES['document']['name']) ? $_FILES['document']['name'] : "No File Selected",
                'document' => isset($filenames['document']) ? $filenames['document'] : "No File Selected",
            );
            $this->cm->table_name = "supplierbills";
            if($this->cm->insert($insert_data)){
                $this->send_success('Bill Added Successfully');
            }else{
                $this->send_error('Can\'t Add Bill Now, Please Try Again');
            }
        }
    }

    public function delete($ID=NULL){
		$this->input->is_ajax_request() || exit('You Cant Access This Page Directly');
		$this->session->usertype == "Admin" || exit('You dont Have Permission To Do This');
        $this->cm->table_name = "bills";
        $this->cm->where = array("ID"=>$ID);
        $site = $this->cm->get()->row();
		$this->check_site_status($site->siteID);
		$this->cm->reset_query();
        $this->cm->table_name = "bills";
        $this->cm->where = array("ID"=>$ID);
        $bill = $this->cm->get();
        if($bill->num_rows() === 1){
            if($this->cm->delete_file('./uploads/'.$bill->row()->document)){
                if($this->cm->delete()){
                    $this->send_success('Bill Deleted Successfully');
                }else{
                    $this->send_error('Can\'t Delete Bill, Please Try Again');
                }
            }else{
                $this->send_error('Can\'t Delete File, Please Try Again');
            }
        }else{
            $this->send_error('Can\'t Find Any Bill Regarding This ID');
        }
    }

    public function delete_from_supplier($ID=NULL){
		$this->input->is_ajax_request() || exit('You Cant Access This Page Directly');
		$this->session->usertype == "Admin" || exit('You dont Have Permission To Do This');
        $this->cm->table_name = "supplierbills";
        $this->cm->where = array("ID"=>$ID);
        $bill = $this->cm->get();
        if($bill->num_rows() === 1){
            if($this->cm->delete_file('./uploads/'.$bill->row()->document)){
                if($this->cm->delete()){
                    $this->send_success('Bill Deleted Successfully');
                }else{
                    $this->send_error('Can\'t Delete Bill, Please Try Again');
                }
            }else{
                $this->send_error('Can\'t Delete File, Please Try Again');
            }
        }else{
            $this->send_error('Can\'t Find Any Bill Regarding This ID');
        }
    }

}
