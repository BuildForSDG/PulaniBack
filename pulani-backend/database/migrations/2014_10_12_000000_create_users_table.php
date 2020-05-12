<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('title', ['Mr', 'Mrs', 'Ms']);
            $table->longText('other');
            $table->enum("gender", ["Male", "Female"]);
            $table->string('surname');
            $table->string('firstname');
            $table->string('othernames')->nullable();
            $table->date('dob');
            $table->string('telephone');
            $table->string('number_of_dependents');
            $table->string('passport')->nullable();
            $table->string('voters_id');
            $table->string('drivers_licence')->nullable();
            $table->string('id_number');
            $table->string('photo')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
