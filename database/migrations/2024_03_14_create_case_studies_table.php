<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('case_studies')) {
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('category');
            $table->string('duration');
            $table->string('role');
            $table->text('description');
            $table->string('link')->nullable();
            $table->json('tags')->nullable();
            $table->json('stats')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }
    }
    public function down()
    {
        Schema::dropIfExists('case_studies');
    }
};