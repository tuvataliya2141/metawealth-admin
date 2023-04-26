<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWealthManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wealth_management', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->string('event_name')->nullable();
            $table->string('event_budget')->nullable();
            $table->integer('event_year')->nullable();
            $table->string('income_name')->nullable();
            $table->string('income_budget')->nullable();
            $table->integer('income_year')->nullable();
            $table->integer('total_wealth')->nullable();
            $table->integer('age')->nullable();
            $table->integer('rate_return')->nullable();
            $table->integer('event_start_year')->nullable();
            $table->integer('event_end_year')->nullable();
            $table->text('devide_year')->nullable();
            $table->integer('down_payment')->nullable();
            $table->double('interest')->nullable();
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
        Schema::dropIfExists('wealth_management');
    }
}
