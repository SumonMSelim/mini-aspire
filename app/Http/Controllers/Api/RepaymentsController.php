<?php

namespace App\Http\Controllers\Api;

use App\Events\RepaymentCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\Repayment as RepaymentResource;
use App\Models\Loan;

class RepaymentsController extends Controller
{
    public function create()
    {
        $rules = [
            'repayment_amount' => ['required', 'regex:/^\d*(\.\d{2})?$/'],
            'repayment_method' => 'required|string',
        ];

        $data = request()->only([
            'repayment_amount', 'repayment_method'
        ]);

        $response = $this->validateWithJson($data, $rules);

        // if validation passes, proceed to create the repayment
        if ($response === true) {
            // check if user has any approved (but not fully repaid) loan
            $loan = Loan::select(['id', 'approved_amount', 'interest_rate', 'loan_tenor'])
                ->where('user_id', auth()->user()->id)
                ->where('status', Loan::LOAN_STATUS_APPROVED)
                ->first();

            // if approved (but not fully repaid) loan found, proceed to create a repayment for that loan
            if ($loan) {
                try {
                    $total_interest = $loan->approved_amount * ($loan->interest_rate * $loan->loan_tenor / 100);
                    $total_amount_repayable = $loan->approved_amount + $total_interest;
                    $monthly_total_repayment = number_format($total_amount_repayable / $loan->loan_tenor, 2, '.', '');

                    if ($monthly_total_repayment === (string)$data['repayment_amount']) {
                        $repayment = $loan->repayments()->create($data);
                        event(new RepaymentCreated($repayment));

                        return $this->respondWithSuccess('Repayment created.', ['repayment' => RepaymentResource::make($repayment)]);
                    }

                    return $this->respondWithError('You must pay a repayment amount of ' . number_format($monthly_total_repayment, 2));
                } catch (\Exception $e) {
                    return $this->respondWithError('Something went wrong! Please try again.');
                }
            }

            return $this->respondWithError('No unpaid loan found to make a repayment.', [], 401);
        }

        return $this->respondWithError('Data validation failed.', $response);
    }
}
