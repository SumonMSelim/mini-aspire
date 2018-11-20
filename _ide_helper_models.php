<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property string $password
 * @property string|null $signup_role
 * @property string|null $signup_looking_for
 * @property string|null $heard_through
 * @property string|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereHeardThrough($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSignupLookingFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSignupRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Loan
 *
 * @property int $id
 * @property int $user_id
 * @property float $requested_amount Between SGD$5,000 to SGD$100,000
 * @property string $loan_tenor 1 month to 6 months
 * @property string $repayment_frequency
 * @property int $origination_fee_percentage one-time ranging from 1% to 6% fee
 * @property int $interest_rate Between 1.5% to 4% per month
 * @property float $disbursed_amount requested amount - origination fee
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereDisbursedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereInterestRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereLoanTenor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereOriginationFeePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereRepaymentFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereRequestedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan whereUserId($value)
 */
	class Loan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Repayment
 *
 * @property int $id
 * @property int $user_id
 * @property int $loan_id
 * @property float $repayment_amount
 * @property string $repayment_method Internet Banking Transfer, PayNow, Cheques, ATM Transfers, Cash Deposit
 * @property string $paid_at
 * @property-read \App\Models\Loan $loan
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment whereLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment whereRepaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment whereRepaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment whereUserId($value)
 */
	class Repayment extends \Eloquent {}
}

