<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbookingReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibooking__reservations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');

            $table->text('description');
            $table->double('value', 30, 2)->default(0);
            $table->tinyInteger('status')->default(0)->unsigned();

            $table->integer('slot_id')->unsigned()->nullable();
            $table->foreign('slot_id')->references('id')->on('ibooking__slots')->onDelete('restrict');

            $table->integer('day_id')->unsigned()->nullable();
            $table->foreign('day_id')->references('id')->on('ibooking__days')->onDelete('restrict');

            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            $table->string('plan')->default('')->nullable();
            $table->integer('plan_id')->unsigned()->nullable();
            $table->string('people')->default('')->nullable();
            $table->text('options')->default('')->nullable();
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->text('entity')->default('')->nullable();
            $table->text('entity_id')->default('')->nullable();

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
        Schema::dropIfExists('ibooking__reservations');
    }
}
