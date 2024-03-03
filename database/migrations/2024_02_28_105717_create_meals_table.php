<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //create meals table
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category')->nullable();
            $table->timestamps();
            //enable soft delete
            $table->softDeletes();
            //connect category with a meal 
            $table->foreign('category')->references('id')->on('categories');
        });

        //create table for meal title and description translations
        Schema::create('meal_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meal_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title')->unique();
            $table->longText('description');

            $table->unique(['meal_id', 'locale']);
            //connect meal with meal translations 
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
        Schema::dropIfExists('meal_translations');
    }
};
