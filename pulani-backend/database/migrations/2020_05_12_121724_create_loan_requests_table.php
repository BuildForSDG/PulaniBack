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
            $table->string('name_of_business');
            $table->string('address_of_business');
            $table->string('location_of_business');
            $table->string('telephone_number');
            $table->float('total_business_capital', 15, 2)->nullable();
            $table->float('loan_request_amount', 15, 2)->nullable();
            $table->integer('number_of_years_in_business');
            $table->longText('proposed_collaterals');
            $table->longText('direction_of_route_to_business');
            $table->longText('direction_of_route_to_residence');
            $table->date('date_form_submitted');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
