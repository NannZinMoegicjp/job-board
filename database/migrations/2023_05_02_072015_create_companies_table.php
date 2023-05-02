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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('contact_person');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->string('company_name');
            $table->string('logo')->nullable();
            $table->string('websitelink')->nullable();
            $table->string('no_of_employee');
            $table->integer('no_of_credit')->default('0');
            $table->date('established_date');           
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
