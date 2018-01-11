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
                $result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"".urlencode($document->document)."\",\"".urlencode($document->filename)."\")'><i class=\"ti-download\"></i> Download</button>";
                $result[] = delete_button('documents/delete/'.$document->ID);
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

    public function download($url,$filename = NULL){
        $this->load->helper('download');
        if($url && $filename){
            force_download($filename,file_get_contents(base_url('uploads/'.$url)));
        }else{
            force_download($url,file_get_contents(base_url('uploads/'.$url)));
        }
    }

}