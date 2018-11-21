<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Repayment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $total_interest = $this->loan->approved_amount * ($this->loan->interest_rate * $this->loan->loan_tenor / 100);
        $total_amount_repayable = $this->loan->approved_amount + $total_interest;
        $monthly_total_repayment = $total_amount_repayable / $this->loan->loan_tenor;

        return [
            'id' => (int)$this->id,
            'user' => $this->user->full_name,
            'total_amount_repayable' => number_format($total_amount_repayable, 2),
            'monthly_total_repayment' => number_format($monthly_total_repayment, 2),
            'currency' => $this->loan->currency,
            'loan_tenor' => $this->loan->loan_tenor . ' ' . str_plural('month', $this->loan->loan_tenor),
            'tenor_paid' => $this->loan->repayments()->count(),
        ];
    }
}
