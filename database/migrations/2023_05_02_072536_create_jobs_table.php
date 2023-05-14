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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->string('gender');
            $table->integer('open_position');
            $table->unsignedBigInteger("job_category_id");            
            $table->foreign("job_category_id")->references('id')->on('job_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger("experience_level_id");
            $table->foreign("experience_level_id")->references('id')->on('experience_levels')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger("employment_type_id");
            $table->foreign("employment_type_id")->references('id')->on('employment_types')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger("address_id");
            $table->foreign("address_id")->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade');   
            $table->mediumText('description')->nullable();   
            $table->mediumText('requirement')->nullable();  
            $table->mediumText('benefit')->nullable();     
            $table->string('status');            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
