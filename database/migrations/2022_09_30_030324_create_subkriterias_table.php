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
        Schema::create('subkriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria_id')->index()->nullable();
            $table->string('nama_sub');
            $table->integer('nilai_sub');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->foreign('kriteria_id')->references('id')->on('kriterias')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subkriterias');
    }
};
