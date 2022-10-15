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
        Schema::table('actions', function (Blueprint $table) {
            //
            $table->foreignId('user_id')->after('id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('schedule_id')->after('id')->nullable()->constrained()->cascadeOnDelete();
            $table->datetime('start');
            $table->datetime('finish');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actions', function (Blueprint $table) {
            //
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);
            $table->dropForeign(['schedule_id']);
            $table->dropColumn(['schedule_id']);
            $table->dropColumn(['start']);
            $table->dropColumn(['finish']);
          });
    }
};
