<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->float('loanrequestamount', 15, 2)->nullable();            
            $table->longText('proposedcollaterals');
            $table->longText('purposeofloan');
            $table->string('loanwithanotherbank');
            $table->longText('detailsofotherloan');
            $table->longText('location_of_business');
            $table->string('loanperiod');
            $table->string('interestrate');
            $table->string('loanissuer');
            $table->date('date_form_submitted');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
