<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminlogininfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('adminlogininfo')) {
            Schema::create('adminlogininfo', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('admin_id');
                $table->string('name');
                $table->string('ip_address', 45); // IPv6 compatible
                $table->string('status');
                $table->text('user_agent')->nullable();
                $table->timestamp('created_at')->useCurrent();

                $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
                $table->index('admin_id');
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
        Schema::dropIfExists('adminlogininfo');
    }
}