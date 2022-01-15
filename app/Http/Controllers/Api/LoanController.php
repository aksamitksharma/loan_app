<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Loans;
use App\Models\LoanRepayments;
use Validator;

class LoanController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $loan_data = $request->all();

        $validator = Validator::make($loan_data, [
            'loan_amount' => 'required|numeric|min:1',
            'loan_term' => 'required|numeric|min:1'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ];
    
            return response()->json($response, '404');
        }
        $loan_data['user_id'] = auth()->user()->id;
        $loan_data['status'] = 1;
        $loan_data['approval_status'] = 1;
        $loan_data['modified_by'] = 0;
        $loan = Loans::create($loan_data);

        $response = [
            'success' => true,
            'data'    => $loan,
            'message' => 'Loan request has been sent successfully.',
        ];

        return response()->json($response, 200);
    }

    /**
     *  Store loan repayment
     *
     *  @param \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */

    public function postLoanRepayment(Request $request)
    {
        $loan_data = $request->all();

        $validator = Validator::make($loan_data, [
            'loan_id' => 'required|integer',
            'repay_amount' => 'required|numeric|min:1'
        ]);

        $loandInfo = Loans::findOrFail($request->loan_id);
        $repayAmt = ($loandInfo->loan_amount / $loandInfo->loan_term);
        if($repayAmt != $request->repay_amount) {
            $response = [
                'success' => false,
                'message' => 'Repayment Warning.',
                'data' => 'Your repayment amount not match with approved repayment amount ('.$repayAmt.').'
            ];
    
            return response()->json($response, '404');
        }

        $repay = new LoanRepayments;
        $repay->loan_id = $request->loan_id;
        $repay->amount = $request->repay_amount;
        $repay->save();

        $response = [
            'success' => true,
            'data'    => 'Repayment Success.',
            'message' => 'Your payment has been successfully received.',
        ];

        return response()->json($response, 200);
    }
}
