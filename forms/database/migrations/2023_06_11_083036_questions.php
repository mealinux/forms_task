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
      Schema::create('questions', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->unsignedBigInteger('form_id')->nullable();
         $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
         $table->string('google_item_id', 10);
         $table->string('type');
         $table->string('title')->nullable();
         $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('questions');
    }
};
