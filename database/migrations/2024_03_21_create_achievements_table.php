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
        if (!Schema::hasTable('achievements')) {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique(); // clients, projects, reviews, etc.
            $table->integer('number');
            $table->string('label');
            $table->text('description');
            $table->string('icon')->default('fas fa-star'); // Font Awesome icon class
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};