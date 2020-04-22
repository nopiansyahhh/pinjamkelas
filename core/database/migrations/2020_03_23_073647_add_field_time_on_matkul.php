<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTimeOnMatkul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matkul', function (Blueprint $table) {
            $table->string('hari',10)->after('sks')->nullable();
            $table->time('jam_mulai')->after('hari')->nullable();
            $table->time('jam_selesai')->after('jam_mulai')->nullable();
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
        Schema::table('matkul', function (Blueprint $table) {
            $table->dropColumn('jam_mulai');
            $table->dropColumn('jam_selesai');
        });
    }
}
