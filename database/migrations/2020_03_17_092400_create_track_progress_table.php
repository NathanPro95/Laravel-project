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
            $table->integer('handover_gorund')->nullable();
            $table->integer('handover_of_subpplies')->nullable();
            $table->integer('construction')->nullable();
            $table->string('area')->nullable();
            $table->bigInteger('schedules_id')->unsigned();
            $table->foreign('schedules_id')
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
