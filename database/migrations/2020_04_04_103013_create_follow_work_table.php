<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_work', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('area');
            $table->integer('finish');
            $table->string('note')->nullable();
            $table->dateTime('expected_complete_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->bigInteger('track_progress_id')->unsigned();
            $table->foreign('track_progress_id')
                ->references('id')->on('track_progress')
                ->onDelete('cascade');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')
                ->references('id')->on('construction_items');
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
        Schema::dropIfExists('follow_work');
    }
}
