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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('country');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')
                ->on('areas')->onDelete('cascade');
            $table->unsignedBigInteger('institution_id');
            $table->foreign('institution_id')->references('id')
                ->on('admins')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
