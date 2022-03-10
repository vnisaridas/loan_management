<?php 

namespace App\Services;

use App\Models\LoanDetail;
use DateTime;
use Schema;
use DB;

class LoanService {

	/**
	 * CERATE THE EMI TABLE 
	 */
	public function CreateLoanEmiTable(){
		$firstDate = LoanDetail::OrderBy('first_payment_date','ASC')->first()->first_payment_date;
		$lastDate = LoanDetail::OrderBy('last_payment_date','DESC')->first()->last_payment_date;
		$table_columns = $this->CreateDynamicColoumn($firstDate,$lastDate);
		$this->CreateTable($table_columns);
		$this->InsertTable($table_columns);		
	}

	/**
	 *  INSERT DATA TO TABLE 
	 */
	public function InsertTable($dates){
		$loans = LoanDetail::get();
		if(!empty($loans)) {
            foreach($loans as $loan) {
            	$loan_emi = $this->LoanEmiCalculate($loan);
            	$loan_amount = $loan->loan_amount;
                $emi_dates = $this->GetEmaiDates($loan->first_payment_date,$loan->last_payment_date);
                //print_r($emi_dates);
            	//echo $loan_emi;
            	$col_qry = "(client_id";
                $val_qry = " VALUES (".$loan->client_id;
            	if(!empty($emi_dates)) {
            		foreach($emi_dates as $emi_date){
            			$monthly_amt_insert =($loan_emi < $loan_amount) ? $loan_emi : $loan_amount;
            			//echo $monthly_amt_insert.'<br/>';
            			$fieldname = date('Y_M',strtotime($emi_date));
            			$col_qry .= ",".$fieldname;
                		$val_qry .= ",".$monthly_amt_insert;
                		$loan_amount -= $loan_emi;
            		}
            	}
            	$col_qry .= ")";
                $val_qry .= ")";
            	$mainQuery = "INSERT INTO emi_details ".$col_qry.$val_qry;
            	DB::statement($mainQuery);
            	//echo $mainQuery;

            }
        }
	}

	/**
	 * 
	 */
	public function LoanEmiCalculate($loan){
		$emi = $loan->loan_amount / $loan->num_of_payment;
        $emi = number_format((float)$emi, 2, '.', '');
        return $emi;
	}

	/**
	 * CREATE TABLE EMI
	 */
	public function CreateTable($dates){
		if(!empty($dates)) {
			$tablename = 'emi_details';
            DB::statement("DROP TABLE  IF EXISTS  $tablename");
            $createQuery = '';
            $createQuery .= "CREATE TABLE emi_details (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,client_id INT(10) NOT NULL";
            foreach($dates as $key => $column) {
            	$fieldname = date('Y_M',strtotime($column));
                $createQuery .= ", `".$fieldname."` DOUBLE(8,2) NULL DEFAULT 0";
            }

            $createQuery .= ")";

            DB::statement($createQuery);
		}

	}

	/**
	 *  GET THE DYNAMIC COLOUMN TO CREATE 
	 */
	public function CreateDynamicColoumn($startdate,$enddate){
		$table_column = [];

        if($startdate != "" && $enddate != "") {

            $begin = new DateTime($startdate);
            $end   = new DateTime($enddate);

            //$begin->modify('first day of this month');
            $end->modify('first day of next month');

            for($i = $begin; $i <= $end; $i->modify('+30 days')){
                $table_column[] = $i->format("Y-m-01");
            }
        }

        return array_unique($table_column);

	}

	/**
	 * 
	 */
	public function GetEmaiDates($startdate,$enddate){
		$table_column = [];

        if($startdate != "" && $enddate != "") {

            $begin = new DateTime($startdate);
            $end   = new DateTime($enddate);

            for($i = $begin; $i <= $end; $i->modify('+30 days')){
                $table_column[] = $i->format("Y-m-01");
            }
        }

        return array_unique($table_column);
	}
}

?>