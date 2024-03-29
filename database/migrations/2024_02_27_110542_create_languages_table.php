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
        //create languages table
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale')->unique();
            $table->string('name');
            $table->timestamps();
            //enable soft deletes
            $table->softDeletes();
            $table->unique(['name','locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
