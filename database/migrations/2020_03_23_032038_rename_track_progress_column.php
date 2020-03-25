<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTrackProgressColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('track_progress', function (Blueprint $table) {
            //
            $table->renameColumn('image', 'image_handover_ground');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('track_progress', function (Blueprint $table) {
            //
            $table->renameColumn('image_handover_ground', 'image');
        });
    }
}
