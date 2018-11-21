<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->decimal('requested_amount', 8, 2)->comment('Between SGD$5,000 to SGD$100,000');
            $table->tinyInteger('loan_tenor')->comment('unit: month');
            $table->string('repayment_frequency', 16)->default('Monthly');
            $table->decimal('origination_fee_percentage', 3, 2)->comment('one-time ranging from 1% to 6% fee');
            $table->decimal('interest_rate', 3, 2)->comment('Between 1.5% to 4% per month');
            $table->decimal('disbursed_amount', 8, 2)->comment('requested amount - origination fee');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
