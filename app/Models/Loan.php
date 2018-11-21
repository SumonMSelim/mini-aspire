<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Loan extends Model
{
    use Notifiable;

    public const LOAN_STATUS_PENDING = 0;
    public const LOAN_STATUS_APPROVED = 1;
    public const LOAN_STATUS_REPAID = 2;
    public const LOAN_STATUS_REJECTED = 3;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($loan) {
            $origination_fee = $loan->approved_amount * ($loan->origination_fee_percentage / 100);

            $loan->user_id = auth()->user()->id;
            $loan->disbursed_amount = $loan->approved_amount - $origination_fee;
            $loan->status = self::LOAN_STATUS_APPROVED;
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function repayments()
    {
        return $this->hasMany(Repayment::class);
    }
}
