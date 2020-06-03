<?php

use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{   
    public function run()
    {
        $loan = \App\Loan::create([            
            'user_id' => 2,
            'loanrequestamount' => 100000,
            'proposedcollaterals' => 'Land title',
            'purposeofloan' => 'To finance new business start up for chappati',
            'loanwithanotherbank' => 'No',
            'detailsofotherloan' => 'None',
            'location_of_business' => 'Namuwongo, Kampala',
            'loanperiod' => '5 months',
            'interestrate' => '5%',
            'loanissuer' => 'NRM youth',
            'date_form_submitted' => '12/09/2010',
        ]);
    }
}
