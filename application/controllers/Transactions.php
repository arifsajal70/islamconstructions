<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Transactions extends MY_Controller{

    function __construct(){
        parent::__construct();
    }

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
            //getting Account Information
            $this->cm->table_name = "accounts";
            $this->cm->where = array('siteID'=>$siteID,'accounttype'=>$post_data['transactiontype']);
            $account = $this->cm->get();

            //getting add balance
            $this->cm->where = array('siteID'=>$siteID,'accounttype'=>"Add Balance");
            $add_balance = $this->cm->get();

            //getting expenses
            $this->cm->where = array('siteID'=>$siteID,'accounttype'=>"Expense");
            $expense = $this->cm->get();

            //checking current balance
            if($add_balance->num_rows() === 1){
                $expense->num_rows() === 1 ? $expense = $expense->row()->amount: $expense = 0;
                $balance = $add_balance->row()->amount - $expense;
            }else{
                $balance = 0;
            }

            if($account->num_rows() > 0){
                if($post_data['transactiontype'] == "Expense"){
                    if($balance < $post_data['amount']){
                        $this->send_error('Don\'t Have Balance For Expense');
                        exit;
                    }
                }
                $insert = array(
                    'siteID' => $siteID,
                    'amount' => $post_data['amount'],
                    'date' => $post_data['date'],
                    'transactiontype' => $post_data['transactiontype'],
                    'note' => $post_data['note'],
                );
                $update = array('amount'=>$post_data['amount'] + $account->row()->amount);
                $this->cm->where = array('ID'=>$account->row()->ID);
                if($this->cm->update($update)){
                    $this->cm->reset_query();
                    $this->cm->table_name = 'transactions';
                    if($this->cm->insert($insert)){
                        $this->send_success('Transaction Added Successfully');
                    }else{
                        $this->send_error('can\'t Add Transaction Now, Please Try Again');
                    }
                }else{
                    $this->send_error('can\'t Update Main Balance, Please Try Again');
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

    public function balance($siteID){
        $this->cm->table_name = 'accounts';
        $this->cm->where = array('siteID'=>$siteID);
        $account = $this->cm->get();
        if($account->num_rows() > 0){
            $html = "";
            $add = (int) 0;
            $expense = (int) 0;
            foreach($account->result() as $acc){
                if($acc->accounttype === "Add Balance"){
                    $add += $acc->amount;
                }elseif($acc->accounttype === "Expense"){
                    $expense += $acc->amount;
                }
                $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
                $html .= "<a class=\"text-black\">";
                $html .= "<strong>".number_format($acc->amount,2)." <small>৳</small></strong>";
                $html .= "<span>".$acc->accounttype."</span>";
                $html .= "</a>";
                $html .= "</div>";
            }
            $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
            $html .= "<a class=\"text-black\">";
            $html .= "<strong>".number_format(($add - $expense),2)."<small> ৳</small></strong>";
            $html .= "<span>Total Balance</span>";
            $html .= "</a>";
            $html .= "</div>";
            $this->send_success($html);
        }else{
            $this->send_error('No Account Report Available');
        }
    }

    public function delete($ID){
        $this->cm->table_name = "transactions";
        $this->cm->where = array('ID'=>$ID);
        $transaction = $this->cm->get();
        if($transaction->num_rows() === 1){
            $this->cm->table_name = "accounts";
            $this->cm->where = array('siteID'=>$transaction->row()->siteID,'accounttype'=>$transaction->row()->transactiontype);
            $account = $this->cm->get();
            if($account->num_rows() === 1){
                $update = array(
                    'amount' => $account->row()->amount - $transaction->row()->amount,
                );
                if($this->cm->update($update)){
                    $this->cm->reset_query();
                    $this->cm->table_name = "transactions";
                    $this->cm->field_name = 'ID';
                    $this->cm->primary_key = $transaction->row()->ID;
                    if($this->cm->delete()){
                        $this->send_success('Transacrion Deleted Successfully');
                    }else{
                        $this->send_error('Can\'t Delete Transaction, Please Try Again');
                    }
                }else{
                    $this->send_error('Can\' Update Main Balance, Please Try Again');
                }
            }else{
                $this->send_error('Invalid Transaction');
            }
        }else{
            $this->send_error('No Transaction Found Regurding This ID');
        }
    }

}