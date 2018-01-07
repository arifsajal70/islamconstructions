<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Sites extends MY_Controller{

    public function index(){
        $data['loader'] = $this->load(array(
                'datatables',
                'upload',
                'alert',
                'datepicker',
                'select2',
                'customjs'=> array(
                    base_url('assets/ajax/main.js'),
                    base_url('assets/ajax/site.js'))
            )
        );
        $data['page_title'] = "Sites";
        $data['subview'] = "sites";
        $this->load->view('mainView',$data);
    }

    public function site_table(){
        $this->cm->table_name = "sites";
        $sites = $this->cm->get();
        if($sites->num_rows() > 0){
            $n=1;
            foreach($sites->result() as $site){
                $result = array();
                $result[] = $n++;
                $result[] = $site->name;
                $result[] = $site->address;
                $result[] = $site->sitetype;
                $result[] = view_button(base_url('sites/single_site/'.$site->ID))." ".edit_button(base_url('sites/single_site/'.$site->ID))." ".delete_button(base_url('sites/delete/'.$site->ID));
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
        $this->form_validation->set_rules('address','Address','trim|xss_clean|required');
        $this->form_validation->set_rules('created','Site Created','trim|xss_clean|required');
        $this->form_validation->set_rules('sitetype','Site Type','trim|xss_clean|required');
        $this->form_validation->set_rules('engineerID','Engineer','trim|xss_clean|required');

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
                'sitetype' => $post_data['sitetype'],
                'engineerID' => $post_data['engineerID'],
                'photo' => $filenames['photo'],
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
        $site = $this->single_site($ID,'array');
        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        $this->form_validation->set_rules('address','Address','trim|xss_clean|required');
        $this->form_validation->set_rules('created','Site Created','trim|xss_clean|required');
        $this->form_validation->set_rules('sitetype','Site Type','trim|xss_clean|required');
        $this->form_validation->set_rules('engineerID','Engineer','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','address','created','sitetype','engineerID'));
            $filenames['photo'] = $site->photo;
            if($_FILES){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $this->cm->delete_file('./uploads/'.$filenames[$key]);
                        $filenames[$key] = $upload['file_name'];
                    }
                }
            }
            $update_data = array(
                'name' => $post_data['name'],
                'address' => $post_data['address'],
                'created' => $post_data['created'],
                'sitetype' => $post_data['sitetype'],
                'engineerID' => $post_data['engineerID'],
                'photo' => $filenames['photo'],
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

}