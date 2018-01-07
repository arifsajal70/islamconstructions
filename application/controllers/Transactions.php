<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Transactions extends MY_Controller{

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
                $result[] = delete_button(base_url('transactions/delete/'.$tran->ID));
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
        $this->form_validation->set_rules('amount','amount','trim|xss_clean|required');
        $this->form_validation->set_rules('date','Date','trim|xss_clean|required');
        $this->form_validation->set_rules('transactiontype','Transaction Type','trim|xss_clean|required');
        $this->form_validation->set_rules('note','Note','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('amount','date','transactiontype','note'));
            $this->cm->table_name = "accounts";
            $this->cm->where = array('siteID'=>$siteID,'accounttype'=>$post_data['transactiontype']);
            $account = $this->cm->get();
            if($account->num_rows() > 0){
                $balance = (int) 0;
                if($post_data['transactiontype'] == "Add Balance"){
                    $balance = $post_data['amount'] + $account->row()->amount;
                }elseif($post_data['transactiontype'] == "Expense"){
                    if($account->row()->amount >= $post_data['amount']){
                        $balance = $post_data['amount'] + $account->row()->amount;
                    }else{
                        $this->send_error('Don\' Have Enought Limit For Expense');
                    }
                }
                $insert = array(
                    'siteID' => $siteID,
                    'amount' => $post_data['amount'],
                    'date' => $post_data['date'],
                    'transactiontype' => $post_data['transactiontype'],
                    'note' => $post_data['note'],
                );
                $update = array(
                    'amount' => $balance,
                );
                $this->cm->table_name = "accounts";
                $this->cm->field_name = 'ID';
                $this->cm->primary_key = $account->row()->ID;
                if($this->cm->update($update)){
                    $this->cm->reset_query();
                    $this->cm->table_name = "transactions";
                    //print_r($this->cm->insert($insert));exit;
                    if($this->cm->insert($insert)){
                        $this->send_success('Transaction Added Successfully');
                    }else{
                        $this->send_error('Can\'t Add Transaction Now, Please Try Again');
                    }
                }else{
                    $this->send_error('Can\'t Update Main Balance, Please Try Again');
                }
            }else{
                $insert_data = array(
                    'siteID' => $siteID,
                    'accounttype' => $post_data['transactiontype'],
                    'amount' => 0,
                );
                $this->cm->table_name = "accounts";
                $this->cm->insert($insert_data);
                $this->add($siteID);
            }
        }
    }

}