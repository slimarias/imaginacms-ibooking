<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbookingDayEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibooking__day_event', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields
        
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('ibooking__events')->onDelete('restrict');

            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')->references('id')->on('ibooking__days')->onDelete('restrict');

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
        Schema::dropIfExists('ibooking__day_event');
    }
}
