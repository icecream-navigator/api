<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIcecreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icecreams', function (Blueprint $table) {
            $table->id();
            $table->string('stall_name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stall_id');
            $table->string('flavour')->nullable();
            $table->string('type')->nullable();
            $table->string('form')->nullable();
            $table->float('price')->nullable();
            $table->integer('quantity')->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('stall_id')
                  ->references('id')
                  ->on('stalls')
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
        Schema::dropIfExists('icecreams');
    }
}
