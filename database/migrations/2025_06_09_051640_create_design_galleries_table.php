<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('design_galleries')) {
            Schema::create('design_galleries', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('image');
                $table->string('link')->nullable();
                $table->string('category');
                $table->boolean('is_featured')->default(false);
                $table->integer('order')->default(0);
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('design_galleries');
    }
}