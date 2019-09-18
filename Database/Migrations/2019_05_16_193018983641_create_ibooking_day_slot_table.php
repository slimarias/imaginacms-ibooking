<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbookingDaySlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibooking__day_slot', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields
            
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')->references('id')->on('ibooking__days')->onDelete('restrict');

            $table->integer('slot_id')->unsigned();
            $table->foreign('slot_id')->references('id')->on('ibooking__slots')->onDelete('restrict');

            

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
        Schema::dropIfExists('ibooking__day_slot');
    }
}
