<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsPersonalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_personalities', function (Blueprint $table) {
            $table->id();

            $table->string("job_id");
            $table->string("personality_id");

            $table->dateTime('created');
            $table->dateTime('modified');
            $table->dateTime('deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs_personalities');
    }
}
