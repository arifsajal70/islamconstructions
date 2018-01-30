<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Sites extends MY_Controller{

    public function constructions_site(){
        $data['loader'] = $this->load(array(
                'datatables',
                'upload',
                'alert',
                'datepicker',
                'select2',
                'customjs'=> array(
                    base_url('assets/ajax/main.js'),
                    base_url('assets/ajax/construction_sites.js'))
            )
        );
        $data['page_title'] = "Construction Sites";
        $data['subview'] = "construction_sites";
        $this->load->view('mainView',$data);
    }

    public function supply_site(){
        $data['loader'] = $this->load(array(
                'datatables',
                'upload',
                'alert',
                'datepicker',
                'select2',
                'customjs'=> array(
                    base_url('assets/ajax/main.js'),
                    base_url('assets/ajax/supply_site.js'))
            )
        );
        $data['page_title'] = "Supply Sites";
        $data['subview'] = "supply_sites";
        $this->load->view('mainView',$data);
    }

    public function construction_site_table(){
        $this->cm->table_name = "sites";
        if($this->session->usertype == "Admin" || $this->session->usertype == "Manager"):
        $this->cm->where = array('sitetype'=>'construction');
        elseif($this->session->usertype == "Engineer"):
        $this->cm->where = array('sitetype'=>'construction','engineerID'=>$this->session->ID,'status'=>1);
        endif;
        $sites = $this->cm->get();
        if($sites->num_rows() > 0){
            $n=1;
            foreach($sites->result() as $site){
                $result = array();
                $result[] = $n++;
                $result[] = $site->name;
                $result[] = $site->address;
                $result[] = $site->sitetype;
                $result[] = status_switch($site->status,base_url("sites/status/$site->ID/$site->status"));
                if($this->session->usertype == "Admin"):
                $result[] = view_button(base_url('sites/single_site/'.$site->ID))." ".edit_button(base_url('sites/single_site/'.$site->ID))." ".delete_button(base_url('sites/delete/'.$site->ID));
                elseif($this->session->usertype == "Manager"):
                $result[] = view_button(base_url('sites/single_site/'.$site->ID))." ".edit_button(base_url('sites/single_site/'.$site->ID));
                elseif($this->session->usertype == "Engineer"):
                $result[] = view_button(base_url('sites/single_site/'.$site->ID));
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

    public function supply_site_table(){
        $this->input->is_ajax_request() || show_404();
        $this->session->usertype == "Admin" || $this->session->usertype == "Manager" || $this->session->usertype == "Site Manager" || exit('Permission Not Granted');
        if($this->session->usertype == "Admin" || $this->session->usertype == "Manager"){
            $this->cm->table_name = "sites";
            $this->cm->where = array('sitetype'=>'supply');
            $sites = $this->cm->get();
        }elseif($this->session->usertype == "Site Manager"){
            $this->cm->table_name = "sitemanagers";
            $this->cm->join = array('sites'=>'sitemanagers.siteID=sites.ID');
            $this->cm->where = array('managerID'=>$this->session->ID);
            $sites = $this->cm->get();
        }
        if($sites->num_rows() > 0){
            $n=1;
            foreach($sites->result() as $site){
                $result = array();
                $result[] = $n++;
                $result[] = $site->name;
                $result[] = $site->address;
                $result[] = $site->sitetype;
                $result[] = status_switch($site->status,base_url("sites/status/$site->ID/$site->status"));
                if($this->session->usertype == "Admin"):
                $result[] = view_button(base_url('sites/single_site/'.$site->ID))." ".edit_button(base_url('sites/single_site/'.$site->ID))." ".delete_button(base_url('sites/delete/'.$site->ID));
                elseif($this->session->usertype == "Manager"):
                $result[] = view_button(base_url('sites/single_site/'.$site->ID))." ".edit_button(base_url('sites/single_site/'.$site->ID));
                elseif($this->session->usertype == "Site Manager"):
                $result[] = view_button(base_url('sites/single_site/'.$site->ID));
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

    public function add($sitetype=NULL){
        $this->input->is_ajax_request() || show_404();
        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        $this->form_validation->set_rules('address','Address','trim|xss_clean|required');
        $this->form_validation->set_rules('created','Site Created','trim|xss_clean|required');
        //check if site was construction or not and set engineer validation for construction site type
        if($sitetype == "Construction"):
            $this->form_validation->set_rules('engineerID','Engineer','trim|xss_clean|required');
        endif;

        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','address','created','sitetype','engineerID'));
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
                'name' => $post_data['name'],
                'address' => $post_data['address'],
                'created' => $post_data['created'],
                'sitetype' => $sitetype,
                'engineerID' => $post_data['engineerID'],
                'photo' => isset($filenames['photo']) ? $filenames['photo'] : "No File Selected",
            );
            if(isset($insert_data)){
                $this->cm->reset_query();
                $this->cm->table_name = "sites";
                $insert = $this->cm->insert($insert_data);
                if($insert){
                    $this->send_success($post_data['sitetype'].' Site Added Successfully');
                }else{
                    $this->send_error('Can\' Add Site Now, Please Try Again');
                }
            }
        }
    }

    public function single_site($ID = NULL,$return_type = 'json'){
        if($ID != NULL){
            $this->cm->table_name = "sites";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $ID;
            $sites = $this->cm->get();
            if($sites->num_rows() == (int) 1){
                foreach($sites->result() as $key => $value){
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
                $this->send_error('No Site Found Regarding This ID');
            }
        }else{
            $this->send_error('No Argument Passed');
        }
    }

    public function edit($ID){
        $this->input->is_ajax_request() || show_404();
        $site = $this->single_site($ID,'array');
        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        $this->form_validation->set_rules('address','Address','trim|xss_clean|required');
        $this->form_validation->set_rules('created','Site Created','trim|xss_clean|required');
        if($site->sitetype == "Construction"):
            $this->form_validation->set_rules('engineerID','Engineer','trim|xss_clean|required');
        endif;
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','address','created','sitetype','engineerID'));
            if($_FILES){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $this->cm->delete_file('./uploads/'.$site->photo);
                        $filenames[$key] = $upload['file_name'];
                    }
                }
            }
            $update_data = array(
                'name' => $post_data['name'],
                'address' => $post_data['address'],
                'created' => $post_data['created'],
                'engineerID' => $post_data['engineerID'],
                'photo' => isset($filenames['photo']) ? $filenames['photo'] : $site->photo,
            );
            $this->cm->table_name = "sites";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $site->ID;
            if($this->cm->update($update_data)){
                $this->send_success('Site Updated Successfully');
            }else{
                $this->send_error('Can\' Update Site Now, Please Try Again');
            }
        }
    }

    public function delete($ID = NULL){
        $this->input->is_ajax_request() || show_404();
        $site = $this->single_site($ID,'array');
        if($this->cm->delete_file('./uploads/'.$site->photo)){
            $this->cm->_table_name = "sites";
            $this->cm->_field_name = "ID";
            $this->cm->_primary_key = $ID;
            if($this->cm->delete()){
                $this->send_success('Site Deleted Successfully');
            }else{
                $this->send_error('Can\'t Delete Right Now, Please Try Again');
            }
        }
    }

    public function status($ID,$status){
        $this->input->is_ajax_request() || show_404();
        switch ($status){
            case (int) 0;
                $status = (int) 1;
                break;
            case (int) 1;
                $status = (int) 0;
                break;
        }
        $status  = array('status'=>$status);
        $this->cm->table_name = "sites";
        $this->cm->field_name = "ID";
        $this->cm->primary_key = $ID;
        if($this->cm->update($status)){
            $this->send_success('Status Updated Successfully');
        }else{
            $this->send_error('Can\' Update Status Now, Please Try Again');
        }
    }

}
