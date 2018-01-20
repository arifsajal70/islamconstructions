<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Payments extends MY_Controller{

    public function payments_table($siteID){
        $this->cm->table_name = "payments";
        $this->cm->where = array('siteID'=>$siteID);
        $payments = $this->cm->get();
        if($payments->num_rows() > 0){
            $n=1;
            foreach($payments->result() as $payment){
                $result = array();
                $result[] = $n++;
                $result[] = $payment->title;
                $result[] = $payment->date;
                $result[] = $payment->amount;
                $result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"payments\",\"".$payment->ID."\")'><i class=\"ti-download\"></i> Download</button>";
                $result[] = delete_button(base_url('payments/delete/'.$payment->ID));
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
        $this->form_validation->set_rules('title','Title','trim|xss_clean|required');
        $this->form_validation->set_rules('date','Date','trim|xss_clean|required');
        $this->form_validation->set_rules('amount','Amount','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('title','date','amount'));
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
                'amount' => $post_data['amount'],
                'filename' => $_FILES['document']['name'],
                'document' => $filenames['document'],
            );
            $this->cm->table_name = "payments";
            if($this->cm->insert($insert_data)){
                $this->send_success('Payment Added Successfully');
            }else{
                $this->send_error('Can\'t Add Payment Now, Please Try Again');
            }
        }
    }

    public function delete($ID){
        $this->cm->table_name = "payments";
        $this->cm->where = array('ID'=>$ID);
        $payment = $this->cm->get();
        if($payment->num_rows() === 1){
            if($this->cm->delete_file('./uploads/'.$payment->row()->document)){
                if($this->cm->delete()){
                    $this->send_success('Payment Deleted Successfully');
                }else{
                    $this->send_error('Can\'t Delete Payment, Please Try Again');
                }
            }else{
                $this->send_error('Can\'t Delete Payment, Please Try Again');
            }
        }else{
            $this->send_error('can\'t Found Payment Regarding This ID');
        }
    }

    public function payments_report($siteID){
        $this->cm->select_sum = "amount";
        $this->cm->table_name = "bills";
        $this->cm->where = array('siteID'=>$siteID);
        $bill = $this->cm->get()->row()->amount ? $this->cm->get()->row()->amount : number_format(0,2) ;

        $this->cm->select_sum = "amount";
        $this->cm->table_name = "payments";
        $this->cm->where = array('siteID'=>$siteID);
        $payment = $this->cm->get()->row()->amount ? $this->cm->get()->row()->amount : number_format(0,2)  ;

        $html = "";
        $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
        $html .= "<a class=\"text-black\">";
        $html .= "<strong>".number_format($bill , 2)." <small>৳</small></strong>";
        $html .= "<span>Total Billed</span>";
        $html .= "</a>";
        $html .= "</div>";

        $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
        $html .= "<a class=\"text-black\">";
        $html .= "<strong>".number_format($payment , 2)." <small>৳</small></strong>";
        $html .= "<span>Total Payment</span>";
        $html .= "</a>";
        $html .= "</div>";

        $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
        $html .= "<a class=\"text-black\">";
        $html .= "<strong>".(number_format($bill - $payment , 2))." <small>৳</small></strong>";
        $html .= "<span>Total Due</span>";
        $html .= "</a>";
        $html .= "</div>";

        $this->send_success($html);
    }

}