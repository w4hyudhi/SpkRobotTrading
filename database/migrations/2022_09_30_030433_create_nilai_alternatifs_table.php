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
        Schema::create('nilai_alternatifs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('alternatif_id')->index()->nullable();
            $table->unsignedBigInteger('subkriteria_id')->index()->nullable();
            $table->integer('nilai')->nullable();;
//            $table->timestamps();
            $table->foreign('alternatif_id')
                ->references('id')
                ->on('alternatifs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('subkriteria_id')
                ->references('id')
                ->on('subkriterias')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('nilai_alternatifs');
    }
};
