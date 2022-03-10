<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\LoanDetail;

class LoanDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dbArray = array(
            array(
                "client_id"             => 101,                    
                "num_of_payment"        => 12,
                "first_payment_date"    => "2017-06-29" ,
                "last_payment_date"     => "2018-05-29",
                "loan_amount"           => 1250.00
            ),
            array(
                "client_id"             => 102,                    
                "num_of_payment"        => 7,
                "first_payment_date"    => "2018-02-15" ,
                "last_payment_date"     => "2018-08-15",
                "loan_amount"           => 20000.00
            ),
            array(
                "client_id"             => 105,                    
                "num_of_payment"        => 17,
                "first_payment_date"    => "2018-11-09" ,
                "last_payment_date"     => "2020-03-09",
                "loan_amount"           => 15000.00
            ),
            array(
                "client_id"             => 106,                    
                "num_of_payment"        => 3,
                "first_payment_date"    => "2019-03-16" ,
                "last_payment_date"     => "2019-05-16",
                "loan_amount"           => 200.00
            ),
        );
        foreach( $dbArray as $data) {

            LoanDetail::create($data);
        }
    }
}
