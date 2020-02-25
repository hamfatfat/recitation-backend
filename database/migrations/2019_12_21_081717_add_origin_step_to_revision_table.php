<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOriginStepToRevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('revisionsteps', function (Blueprint $table) {
            $table->unsignedBigInteger('origin_step_id')->nullable();
            $table->string('alias_step_id')->nullable();
            $table->foreign('origin_step_id')
                    ->references('id')->on('steps')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('revisionsteps', function (Blueprint $table) {
            //
        });
    }
}
