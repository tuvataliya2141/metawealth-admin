<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('birth_date');
            $table->string('gender');
            $table->string('nationality');
            $table->string('occupation');
            $table->string('industry');
            $table->string('employer');
            $table->string('id_type');
            $table->string('id_number');
            $table->string('id_place');
            $table->string('phone_number');
            $table->string('cell_phone');
            $table->string('fax');
            $table->string('email');
            $table->string('address');
            $table->string('receiving_funds');
            $table->string('sending_funds');
            $table->string('expected_transaction');
            $table->string('annual_income');
            $table->string('source_funds');
            $table->string('trading_purpose');
            $table->dateTime('date_of_contact')->nullable();
            $table->string('mode_of_contact')->nullable();
            $table->text('notes_from_contact')->nullable();
            $table->dateTime('followup_date')->nullable();
            $table->string('status')->nullable();
            $table->string('followup_notification')->nullable();
            $table->string('followup_notification_email')->nullable();
            $table->string('clients')->default('no');
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
        Schema::dropIfExists('crm_clients');
    }
}
