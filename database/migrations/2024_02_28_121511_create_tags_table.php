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
        //create tags table 
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->timestamps();
            //enable soft delete
            $table->softDeletes();
        });
        //create tags translation table 
        Schema::create('tag_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned();
            $table->string('locale')->index();
         
            $table->string('title');
         
            $table->unique(['tag_id','locale']);
            //connect tags and tags translation table 
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_translations');
    }
};
