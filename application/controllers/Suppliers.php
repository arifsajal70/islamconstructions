<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Suppliers extends MY_Controller{

    public function index(){
        $data['loader'] = $this->load(array(
                'datatables',
                'upload',
                'alert',
                'datepicker',
                'select2',
                'customjs'=> array(
                    base_url('assets/ajax/main.js'),
                    base_url('assets/ajax/supplier.js'))
            )
        );
        $data['page_title'] = "Suppliers";
        $data['subview'] = "suppliers";
        $this->load->view('mainView',$data);
    }

    public function suppliers_table(){
        $this->cm->table_name = "suppliers";
        $suppliers = $this->cm->get();
        if($suppliers->num_rows() > 0){
            $n=1;
            foreach($suppliers->result() as $supplier){
                $result = array();
                $result[] = $n++;
                $result[] = $supplier->name;
                $result[] = $supplier->email;
                $result[] = $supplier->phone;
                $result[] = file_exists('./uploads/'.$supplier->photo) ? "<img src='".base_url('uploads/'.$supplier->photo)."' width='30px' />" : "-";
				$result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"suppliers\",\"".$supplier->ID."\")'><i class=\"ti-download\"></i> Download</button>";
                $result[] = view_button(base_url('suppliers/single_supplier/'.$supplier->ID))." ".edit_button(base_url('suppliers/single_supplier/'.$supplier->ID))." ".delete_button(base_url('suppliers/delete/'.$supplier->ID));
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

    public function add(){
        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        $this->form_validation->set_rules('email','Email','trim|xss_clean|valid_email|is_unique[suppliers.email]');
        $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required');
        $this->form_validation->set_rules('address','Address','trim|xss_clean');

        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','email','phone','address'));
            if($_FILES){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $filenames[$key] = $upload['file_name'];
                    }else{
                        $filenames[$key] = "";
                    }
                }
            }
            $insert_data = array(
                'name' => $post_data['name'],
                'email' => $post_data['email'],
                'phone' => $post_data['phone'],
                'address' => $post_data['address'],
                'photo' => isset($filenames['photo']) ? $filenames['photo'] : "No File Selected",
                'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : "No File Selected",
                'document' => isset($filenames['document']) ? $filenames['document'] : "No FIle Selected",
            );
            if(isset($insert_data)){
                $this->cm->reset_query();
                $this->cm->table_name = "suppliers";
                $insert = $this->cm->insert($insert_data);
                if($insert){
                    $this->send_success('Supplier Added Successfully');
                }else{
                    $this->send_error('Can\' Add Supplier Now, Please Try Again');
                }
            }
        }
    }

    public function single_supplier($ID = NULL,$return_type = 'json'){
        if($ID != NULL){
            $this->cm->table_name = "suppliers";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $ID;
            $suppliers = $this->cm->get();
            if($suppliers->num_rows() == (int) 1){
                foreach($suppliers->result() as $key => $value){
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
                $this->send_error('No Employee Found Regarding This ID');
            }
        }else{
            $this->send_error('No Argument Passed');
        }
    }

    public function edit($ID){
        $emp = $this->single_supplier($ID,'array');
        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        if($emp->email == $this->input->post('email')){
            $this->form_validation->set_rules('email','Email','trim|xss_clean|required');
        }else{
            $this->form_validation->set_rules('email','Email','trim|xss_clean|valid_email|is_unique[suppliers.email]');
        }
        $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required');
        $this->form_validation->set_rules('address','Address','trim|xss_clean');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','email','phone','address'));
            if($_FILES){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $this->cm->delete_file('./uploads/'.$emp->$key);
                        $filenames[$key] = $upload['file_name'];
                    }
                }
            }
            $update_data = array(
                'name' => $post_data['name'],
                'email' => $post_data['email'],
                'phone' => $post_data['phone'],
                'address' => $post_data['address'],
				'photo' => isset($filenames['photo']) ? $filenames['photo'] : $emp->photo,
				'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : $emp->filename,
				'document' => isset($filenames['document']) ? $filenames['document'] : $emp->document,
            );
            $this->cm->table_name = "suppliers";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $emp->ID;
            if($this->cm->update($update_data)){
                $this->send_success('Supplier Updated Successfully');
            }else{
                $this->send_error('Can\' Upudate Supplier Now, Please Try Again');
            }
        }
    }

    public function delete($ID = NULL){
        $emp = $this->single_supplier($ID,'array');
        if($this->cm->delete_file('./uploads/'.$emp->photo) && $this->cm->delete_file('./uploads/'.$emp->document)){
            $this->cm->_table_name = "suppliers";
            $this->cm->_field_name = "ID";
            $this->cm->_primary_key = $ID;
            if($this->cm->delete()){
                $this->send_success('Supplier Deleted Successfully');
            }else{
                $this->send_error('Can\'t Delete Right Now, Please Try Again');
            }
        }
    }

}
