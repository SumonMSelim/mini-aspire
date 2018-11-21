<?php

namespace App\Http\Controllers\Api;

use App\Events\LoanCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\Loan as LoanResource;
use App\Models\Loan;

class LoansController extends Controller
{
    public function create()
    {
        $rules = [
            'approved_amount' => 'required|integer',
            'loan_tenor' => 'required|integer',
            'currency' => 'required|string',
            'origination_fee_percentage' => 'required|between:1,6',
            'interest_rate' => 'required|between:1,4',
        ];

        $response = $this->validateWithJson(request()->only([
            'approved_amount', 'loan_tenor', 'currency', 'origination_fee_percentage', 'interest_rate',
        ]), $rules);

        // if validation passes, create the loan
        if ($response === true) {
            try {
                // check if user already has a pending or approved (but not fully repaid) loan
                $loan_exists = Loan::where('user_id', auth()->user()->id)
                    ->whereIn('status', [Loan::LOAN_STATUS_PENDING, Loan::LOAN_STATUS_APPROVED])
                    ->exists();

                // if no pending or approved (but not fully repaid) loan, create the loan
                if ($loan_exists === false) {
                    $loan = Loan::create(request()->all());
                    event(new LoanCreated($loan));

                    return $this->respondWithSuccess('Loan created.', ['loan' => LoanResource::make($loan)]);
                }

                return $this->respondWithError('You already have a pending or unpaid loan.', [], 401);
            } catch (\Exception $e) {
                return $this->respondWithError('Something went wrong! Please try again.');
            }
        }

        return $this->respondWithError('Data validation failed.', $response);
    }

    public function index()
    {
        $loans = Loan::where('user_id', auth()->user()->id)->paginate(10);

        return $this->respondWithSuccess('Loan history loaded.', ['loans' => LoanResource::collection($loans)]);
    }
}
