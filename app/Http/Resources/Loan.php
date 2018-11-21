<?php

namespace App\Http\Resources;

use App\Models\Loan as LoanModel;
use Illuminate\Http\Resources\Json\JsonResource;

class Loan extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $status = [
            LoanModel::LOAN_STATUS_PENDING => 'Pending',
            LoanModel::LOAN_STATUS_APPROVED => 'Approved',
            LoanModel::LOAN_STATUS_REPAID => 'Repaid',
            LoanModel::LOAN_STATUS_REJECTED => 'Rejected',
        ];

        $total_interest = $this->approved_amount * ($this->interest_rate * $this->loan_tenor / 100);
        $total_amount_repayable = $this->approved_amount + $total_interest;
        $monthly_total_repayment = $total_amount_repayable / $this->loan_tenor;

        return [
            'id' => (int)$this->id,
            'user' => $this->user->full_name,
            'approved_amount' => number_format($this->approved_amount, 2),
            'currency' => $this->currency,
            'loan_tenor' => $this->loan_tenor . ' ' . str_plural('month', $this->loan_tenor),
            'origination_fee_percentage' => $this->origination_fee_percentage,
            'interest_rate' => $this->interest_rate,
            'disbursed_amount' => number_format($this->disbursed_amount, 2),
            'total_interest' => number_format($total_interest, 2),
            'total_amount_repayable' => number_format($total_amount_repayable, 2),
            'monthly_total_repayment' => number_format($monthly_total_repayment, 2),
            'status' => $status[$this->status],
        ];
    }
}
