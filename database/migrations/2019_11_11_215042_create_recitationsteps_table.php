<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecitationstepsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('recitationsteps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('soura');
            $table->string('toAya');
             $table->unsignedBigInteger('rev_id');
            $table->foreign('rev_id')
                    ->references('id')->on('revisionsteps')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')
                    ->references('id')->on('schedule')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('recitationstep');
    }

}
