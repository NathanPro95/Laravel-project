<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageHandoverSuppliesToTrackProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('track_progress', function (Blueprint $table) {
            //
            $table->string('image_handover_supplies')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('track_progress', function (Blueprint $table) {
            //
            $table->dropColumn(['image_handover_supplies']);
        });
    }
}
