<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_progress', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('handover_ground')->default(0);
            $table->integer('handover_of_subpplies')->default(0);
            $table->integer('construction')->default(0);
            $table->string('area')->nullable();
            $table->string('image_handover_ground')->nullable();
            $table->string('image_handover_supplies')->nullable();
            $table->bigInteger('schedule_id')->unsigned();
            $table->foreign('schedule_id')
                ->references('id')->on('schedules')
                ->onDelete('cascade');

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
        Schema::dropIfExists('track_progress');
    }
}
