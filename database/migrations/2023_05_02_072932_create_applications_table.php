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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("job_id");
            $table->foreign("job_id")->references('id')->on("jobs")->onDelete('cascade')->onUpdate('cascade');;
            $table->unsignedBigInteger("job_seeker_id");
            $table->foreign("job_seeker_id")->references('id')->on('job_seekers')->onDelete('cascade')->onUpdate('cascade');
            $table->string("cvfile");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
