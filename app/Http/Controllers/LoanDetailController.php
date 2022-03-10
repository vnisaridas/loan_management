<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use App\Models\EmiDetail;
use Illuminate\Http\Request;
use App\Services\LoanService;
use Schema;

class LoanDetailController extends Controller
{   
    protected $loanservice; 

    public function __construct(LoanService $loanservice){
        $this->loanservice = $loanservice;       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = (Schema::hasTable('loan_details')) ? LoanDetail::all() : [];
        return view('loan_detail')->with('details',$details);
    }
    
    /**
     * Display Proccess Data Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function processdataview(){
        $columns = Schema::getColumnListing('emi_details');
        $details = (Schema::hasTable('emi_details')) ? EmiDetail::all()->toArray() : [];
        rsort($columns);
        unset($columns[0]);
        return view('process_data')->with(['headers' => $columns,'details' => $details]);
    }

    public function process(){
        if(Schema::hasTable('loan_details')){
            $this->loanservice->CreateLoanEmiTable();     
        }
        return redirect()->route('process-data');   
    }

    
}
