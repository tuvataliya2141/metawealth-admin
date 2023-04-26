<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_details', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
            $table->text('dob')->nullable();
            $table->text('gender')->nullable();
            $table->text('retired')->nullable();
            $table->text('marital_status')->nullable();
            $table->text('joint_plan')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('address')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->text('city')->nullable();
            $table->text('province')->nullable();
            $table->text('postal_code')->nullable();
            $table->text('is_child')->nullable();
            $table->text('child_tot')->nullable();
            $table->text('child_age')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('personal_details');
    }
}
