<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id('id');
            $table->string(('first_name'));
            $table->string(('last_name'));
            $table->string(('email'))->unique();
            $table->string(('contact_number'));


            $table->string(('profile_photo'));
            $table->string(('assigned_team'));
            $table->string(('designation'));
            $table->string(('company'));
            // $table->string(('joinning_date'));

            $table->string('gender');
            $table->string('languages');
            $table->string('intro');
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
        Schema::dropIfExists('employee_details');
    }
}
