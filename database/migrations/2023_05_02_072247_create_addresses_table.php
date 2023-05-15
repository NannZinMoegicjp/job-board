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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('detail_address');
            $table->unsignedBigInteger("company_id");
            $table->unsignedBigInteger("city_id");
            $table->foreign("company_id")->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("city_id")->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
