<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Transactions extends MY_Controller{

	/**
	 * @param int $siteID Site ID
	 */
    public function transactions_table($siteID = NULL){
        $this->cm->table_name = "transactions";
        $this->cm->where = array('siteID'=>$siteID);
        $transactions = $this->cm->get();
        if($transactions->num_rows() > 0){
            $n=1;
            foreach($transactions->result() as $tran){
                $result = array();
                $result[] = $n++;
                $result[] = $tran->amount;
                $result[] = $tran->date;
                $result[] = $tran->transactiontype;
                $result[] = $tran->note;
                $result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"transactions\",\"".$tran->ID."\")'><i class=\"ti-download\"></i> Download</button>";
                if($this->session->usertype == "Admin"):
                $result[] = delete_button(base_url('transactions/delete/'.$tran->ID));
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

    public function add($siteID = NULL){
        $this->check_site_status($siteID);
        $this->form_validation->set_rules('amount','amount','trim|xss_clean|required');
        $this->form_validation->set_rules('date','Date','trim|xss_clean|required');
        $this->form_validation->set_rules('transactiontype','Transaction Type','trim|xss_clean|required');
        $this->form_validation->set_rules('note','Note','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('amount','date','transactiontype','note'));
            //getting add balance
            $this->cm->select_sum = "amount";
            $this->cm->table_name = "transactions";
            $this->cm->where = array('siteID'=>$siteID,'transactiontype'=>"Add Balance");
            $add_balance = $this->cm->get();

            //getting expenses
            $this->cm->where = array('siteID'=>$siteID,'transactiontype'=>"Expense");
            $expense = $this->cm->get();

            //checking current balance
            if($add_balance->num_rows() === 1){
                $expense->num_rows() === 1 ? $expense = $expense->row()->amount: $expense = 0;
                $balance = $add_balance->row()->amount - $expense;
            }else{
                $balance = 0;
            }

            if($post_data['transactiontype'] == "Expense"){
                if($balance < $post_data['amount']){
                    $this->send_error('Don\'t Have Balance For Expense');
                    exit;
                }
            }

            if($_FILES['document']['name']){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $filenames[$key] = $upload['file_name'];
                    }else{
                        $filenames[$key] = $upload['error'];
                    }
                }
            }

            $insert = array(
                'siteID' => $siteID,
                'amount' => $post_data['amount'],
                'date' => $post_data['date'],
                'transactiontype' => $post_data['transactiontype'],
                'note' => $post_data['note'],
                'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : 'No File Selected',
                'document' => isset($filenames['document']) ? $filenames['document'] : "No File Selected",
            );
            $this->cm->reset_query();
            $this->cm->table_name = "transactions";
            if($this->cm->insert($insert)){
                $this->send_success('Transaction Added Successfully');
            }else{
                $this->send_error('Can\'t Add Transaction Now, Please Try Again');
            }
        }
    }

    public function balance($siteID){
        $this->cm->select_sum = "amount";
        $this->cm->table_name = "transactions";
        $this->cm->where = array('siteID'=>$siteID,'transactiontype'=>"Add Balance");
        $add_balance = $this->cm->get()->row()->amount;

        $this->cm->select_sum = "amount";
        $this->cm->table_name = "transactions";
        $this->cm->where = array('siteID'=>$siteID,'transactiontype'=>"Expense");
        $expense = $this->cm->get()->row()->amount;

        $add_balance ? $add_balance = $add_balance : $add_balance = 0;
        $expense ? $expense = $expense : $expense = 0;
        $current_balance = $add_balance - $expense;

        $html = "";
        $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
        $html .= "<a class=\"text-black\">";
        $html .= "<strong>".number_format($current_balance,2)."<small> ৳</small></strong>";
        $html .= "<span>Current Balance</span>";
        $html .= "</a>";
        $html .= "</div>";
        $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
        $html .= "<a class=\"text-black\">";
        $html .= "<strong>".number_format($add_balance,2)."<small> ৳</small></strong>";
        $html .= "<span>Total Balance Added</span>";
        $html .= "</a>";
        $html .= "</div>";
        $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
        $html .= "<a class=\"text-black\">";
        $html .= "<strong>".number_format($expense,2)."<small> ৳</small></strong>";
        $html .= "<span>Total Expensed</span>";
        $html .= "</a>";
        $html .= "</div>";

        if($html){
            $this->send_success($html);
        }else{
            $this->send_error('No Account Report Available');
        }
    }

    public function delete($ID){
        $this->cm->table_name = "transactions";
        $this->cm->where = array('ID'=>$ID);
        $tran = $this->cm->get();
        $this->check_site_status($tran->row()->siteID);
        if($tran->row()->document){
            if(!$this->cm->delete_file('./uploads/'.$tran->row()->document)){
                $this->send_error('Can\'t Delete File, Please Try Again');
                exit;
            }
        }
        $this->cm->reset_query();
		$this->cm->table_name = "transactions";
		$this->cm->where = array('ID'=>$ID);
        if($this->cm->delete()){
            $this->send_success('Transaction Deleted Successfully');
        }else{
            $this->send_error('Can\'t Delete Transaction Nnw, Please Try Again');
        }
    }

}
