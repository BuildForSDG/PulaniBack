<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\LoanResource;
use App\Loan;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function index()
    {
        $loans = Loan::latest()->paginate(9);
        return LoanResource::collection($loans);
    }

    public function show($id)
    {
        $loan = Loan::findOrFail($id);
        return new LoanResource($loan);
    }

    public function createLoan(Request $request)
    {
        $this->validate($request, [

            'loanrequestamount'    => 'required',
            'proposedcollaterals'  => 'required',
            'purposeofloan'        => 'required',
            'loanwithanotherbank'  => 'required',
            'detailsofotherloan'   => 'required',
            'location_of_business' => 'required',
            'loanperiod'           => 'required',
            'interestrate'         => 'required',
            'loanissuer'           => 'required',
            'date_form_submitted'  => 'required',
        ]);

        $loan = $request->isMethod('put') ? Loan::findOrFail($request->$id) : new Loan;

        $loan->loanrequestamount    = $request->input('loanrequestamount');
        $loan->proposedcollaterals  = $request->input('proposedcollaterals');
        $loan->purposeofloan        = $request->input('purposeofloan');
        $loan->loanwithanotherbank  = $request->input('loanwithanotherbank');
        $loan->detailsofotherloan   = $request->input('detailsofotherloan');
        $loan->location_of_business = $request->input('location_of_business');
        $loan->loanperiod           = $request->input('loanperiod');
        $loan->interestrate         = $request->input('interestrate');
        $loan->loanissuer           = $request->input('loanissuer');
        $loan->date_form_submitted  = $request->input('date_form_submitted');
    }

    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        return new LoanResource($loan);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'loanrequestamount'    => 'required',
                'proposedcollaterals'  => 'required',
                'purposeofloan'        => 'required',
                'loanwithanotherbank'  => 'required',
                'detailsofotherloan'   => 'required',
                'location_of_business' => 'required',
                'loanperiod'           => 'required',
                'interestrate'         => 'required',
                'loanissuer'           => 'required',
                'date_form_submitted'  => 'required',
            ]
        );
        //Update loans
        $loan                       = Loan::findOrFail($id);
        $loan->loanrequestamount    = $request->input('loanrequestamount');
        $loan->proposedcollaterals  = $request->input('proposedcollaterals');
        $loan->purposeofloan        = $request->input('purposeofloan');
        $loan->loanwithanotherbank  = $request->input('loanwithanotherbank');
        $loan->detailsofotherloan   = Hash::make($request->input('detailsofotherloan'));
        $loan->location_of_business = $request->input('location_of_business');
        $loan->loanperiod           = $request->input('loanperiod');
        $loan->interestrate         = $request->input('interestrate');
        $loan->loanissuer           = $request->input('loanissuer');
        $loan->date_form_submitted  = $request->input('date_form_submitted');
        $loan->save();
        return new LoanResource($loan);
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        if ($loan->delete()) {
            return new LoanResource($loan);
        }
    }
}
