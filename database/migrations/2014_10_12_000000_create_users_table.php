<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('otherName')->nullable();
            $table->string('dateOfBirth');
            $table->string('gender');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('idNumber');
            $table->string('idType');
            $table->string('idDateOfIssue');
            $table->string('idExpiryDate');
            $table->string('areaOfResidence');
            $table->string('businessName');
            $table->string('businessAddress')->nullable();
            $table->string('yearsOfBusiness');
            $table->string('totalBusinessCapital');
            $table->string('photo')->nullable();
            $table->string('numberOfDependants')->nullable();
            $table->string('next0fKin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
