<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("media_id");
            $table->string("job_category_id");
            $table->string("job_type_id");
            $table->string("description");
            $table->string("detail");
            $table->string("business_skill");
            $table->string("knowledge");
            $table->string("location");
            $table->string("activity");
            $table->string("academic_degree_doctor");
            $table->string("academic_degree_master");
            $table->string("academic_degree_professional");
            $table->string("academic_degree_bachelor");
            $table->string("salary_statistic_group");
            $table->string("salary_range_first_year");
            $table->string("salary_range_average");
            $table->string("salary_range_remarks");
            $table->string("restriction");
            $table->string("estimated_total_workers");
            $table->string("remarks");
            $table->string("url");
            $table->string("seo_description");
            $table->string("seo_keywords");
            $table->string("sort_order");
            $table->string("publish_status");
            $table->string("version");
            $table->string("created_by");

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
        Schema::dropIfExists('jobs');
    }
}
