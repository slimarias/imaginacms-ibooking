<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbookingEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibooking__events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields
            $table->text('place');
            $table->tinyInteger('status')->default(0)->unsigned();
            $table->text('options')->nullable();
            $table->string('duration')->default('')->nullable();
            $table->string('people')->default('')->nullable();
            $table->string('inforprice')->default('')->nullable();
            $table->text('video')->nullable();

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
        Schema::dropIfExists('ibooking__events');
    }
}
