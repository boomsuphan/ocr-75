<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('room_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('name_professor')->nullable();
            $table->string('note')->nullable();
            $table->string('semester')->nullable();
            $table->date('date_booking')->nullable();
            $table->time('time_start_booking')->nullable();
            $table->time('time_end_booking')->nullable();
            $table->time('time_get_key')->nullable();
            $table->time('time_return_key')->nullable();
            $table->string('code_for_qr')->nullable();
            $table->string('id_officer_give_key')->nullable();
            $table->string('id_officer_return_key')->nullable();
            $table->string('status')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bookings');
    }
}
