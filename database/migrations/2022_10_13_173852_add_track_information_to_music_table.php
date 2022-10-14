<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('music', function (Blueprint $table) {
            $table->string('spotify_track_id')->after('id');

            $table->after('url', function ($table) {
                $table->string('preview_url');
                $table->integer('duration_ms');
                $table->string('spotify_artist_id');
                $table->string('artist_name');
                $table->string('artist_url');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('music', function (Blueprint $table) {
            $table->dropColumn([
                'spotify_track_id',
                'preview_url',
                'duration_ms',
                'spotify_artist_id',
                'artist_name',
                'artist_url',
            ]);
        });
    }
};
