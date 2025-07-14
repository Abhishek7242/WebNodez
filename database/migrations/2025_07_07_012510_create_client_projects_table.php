<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('client_projects')) {
            Schema::create('client_projects', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->string('project_name');
                $table->text('description');
                $table->string('image');
                $table->string('status')->default('in_progress'); // in_progress, completed, on_hold
                $table->integer('progress_percentage')->default(0);
                $table->date('start_date')->nullable();
                $table->date('expected_completion_date')->nullable();
                // Project phases (no dates)
                $table->boolean('design_completed')->default(false);
                $table->boolean('development_completed')->default(false);
                $table->boolean('testing_completed')->default(false);
                $table->boolean('deployment_completed')->default(false);
                // Client email
                $table->string('client_email');
                $table->timestamps();
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
        Schema::dropIfExists('client_projects');
    }
}