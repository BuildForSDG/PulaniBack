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
            $table->string('title')->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('otherName')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('idNumber');
            $table->string('idType')->nullable();
            $table->string('idDateOfIssue')->nullable();
            $table->string('idExpiryDate')->nullable();
            $table->string('areaOfResidence')->nullable();
            $table->string('businessName');
            $table->string('businessAddress')->nullable();
            $table->string('yearsOfBusiness')->nullable();
            $table->string('totalBusinessCapital')->nullable();
            $table->string('photo')->nullable();
            $table->string('numberOfDependants')->nullable();
            $table->string('nextOfKin')->nullable();
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
