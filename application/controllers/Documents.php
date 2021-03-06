<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Documents extends MY_Controller{

    public function documents_table($siteID){
        $this->cm->table_name = "sitedocuments";
        $this->cm->where = array('siteID'=>$siteID);
        $documents = $this->cm->get();
        if($documents->num_rows() > 0){
            $n=1;
            foreach($documents->result() as $document){
                $result = array();
                $result[] = $n++;
                $result[] = $document->title;
                $result[] = $document->note;
                $result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"sitedocuments\",\"".$document->ID."\")'><i class=\"ti-download\"></i> Download</button>";
                if($this->session->usertype == "Admin"):
                $result[] = delete_button(base_url('documents/delete/'.$document->ID));
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
        $this->form_validation->set_rules('title','Document Title','trim|xss_clean|required');
        $this->form_validation->set_rules('note','Note','trim|xss_clean');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('title','note'));
            if(!empty($_FILES['document']['name'])){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $filenames[$key] = $upload['file_name'];
                    }else{
                        $filenames[$key] = $upload['error'];
                        $this->send_error($upload['error']);
                        exit;
                    }
                }
            }else{
                $this->send_error('No File Selected');
                exit;
            }
            $insert = array(
                'siteID' => $siteID,
                'title' => $post_data['title'],
                'note' => $post_data['note'],
                'filename' => $_FILES['document']['name'],
                'document' => $filenames['document'],
            );
            $this->cm->table_name = "sitedocuments";
            if($this->cm->insert($insert)){
                $this->send_success('Document Added Successfully');
            }else{
                $this->send_error('can\'t Add Document Now, Please Try Again');
            }
        }
    }

    public function delete($ID=NULL){
        $this->cm->table_name = "sitedocuments";
        $this->cm->where = array('ID'=>$ID);
        $site = $this->cm->get()->row();
		$this->check_site_status($site->siteID);
		$this->cm->reset_query();

        $this->cm->table_name = "sitedocuments";
        $this->cm->where = array('ID'=>$ID);
        $file = $this->cm->get();
        if($this->cm->delete_file('./uploads/'.$file->row()->document)){
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $ID;
            if($this->cm->delete()){
                $this->send_success('Document Deleted Successfully');
            }else{
                $this->send_error("can\'t Delete File Now, Please Try Again");
            }
        }else{
            $this->send_error("can\'t Delete File Now, Please Try Again");
        }
    }

    public function download($table,$ID){
        $this->load->helper('download');
        if($table == "personal_balance" || $table == "suppliers" || $table == "sitedocuments" || $table == 'bills' || $table == "payments" || $table == "engineers" || $table == "managers" || $table == "employees" || $table == "stocks" || $table == "transactions" || $table == "admins"){
            $this->cm->table_name = $table;
            $this->cm->where = array('ID'=>$ID);
            $document = $this->cm->get();
            if($document->num_rows() === 1){
                if($document->row()->filename && file_exists('./uploads/'.$document->row()->document)){
                    if(!force_download($document->row()->filename,file_get_contents(base_url('uploads/'.$document->row()->document)))){
                        exit('No File Found');
                    }
                }elseif(file_exists('./uploads/'.$document->row()->document)){
                    if(!force_download($document->row()->document,file_get_contents(base_url('uploads/'.$document->row()->document)))){
                        exit('No FIle Found');
                    }
                }else{
                    echo "No File Found";
                }
            }else{
                echo "No File Found";
            }
        }else{
            echo "No File Found";
        }
    }

}
