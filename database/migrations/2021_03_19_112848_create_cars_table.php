<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->integer('mileage')->default(0);
            $table->decimal('price');
            $table->boolean('for_sale')->default(0);
            $table->longText('details')->nullable();
            $table->unsignedBigInteger('modele_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('modele_id')->references('id')->on('modeles');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('cars');
    }
}
