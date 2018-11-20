<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Loan
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Loan query()
 */
	class Loan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Repayment
 *
 * @property-read \App\Models\Loan $loan
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repayment query()
 */
	class Repayment extends \Eloquent {}
}

