<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersToCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_center', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('center_id');
        
            $table->foreign('user_id')->references('id')->on('users')
        
                ->onDelete('cascade');
        
            $table->foreign('center_id')->references('id')->on('centers')
        
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
        Schema::dropIfExists('users_center');
    }
}
