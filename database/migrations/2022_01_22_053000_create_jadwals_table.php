<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('jadwals', function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('id_kelas');
        //     $table->bigInteger('id_grade');
        //     $table->string('mapel_1')->nullable();
        //     $table->string('mapel_2')->nullable();
        //     $table->string('mapel_3')->nullable();
        //     $table->string('mapel_4')->nullable();
        //     $table->string('mapel_5')->nullable();
        //     $table->string('mapel_6')->nullable();
        //     $table->string('mapel_7')->nullable();
        //     $table->string('mapel_8')->nullable();
        //     $table->string('mapel_9')->nullable();
        //     $table->string('mapel_10')->nullable();
        //     $table->string('mapel_11')->nullable();
        //     $table->string('mapel_12')->nullable();
        //     $table->string('mapel_13')->nullable();
        //     $table->string('mapel_14')->nullable();
        //     $table->string('mapel_15')->nullable();
        //     $table->timestamps();
        // });

        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kelas');
            $table->bigInteger('id_grade');
            $table->string('id_mapel');
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
        Schema::dropIfExists('jadwals');
    }
}
