<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stalls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('owner');
            $table->string('rate')->nullable();
            $table->string('rates_time')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('photo_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('town')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('street')->nullable();
            $table->string('place_name')->nullable();

            $table->double('lon', 15,10)->nullable();
            $table->double('lat', 15,10)->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
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
        Schema::dropIfExists('stalls');
    }
}
