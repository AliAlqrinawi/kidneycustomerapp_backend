<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questionnaire_form_fields', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->unsignedInteger('form_id');
            $table->string('type', 255);
            $table->string('class_col', 255);
            $table->longtext('options')->nullable();
            $table->integer('order');
            $table->tinyInteger('required')->comment("1 =>yes, 0=>no")->default(1);
            $table->tinyInteger('is_active')->comment("1 =>active, 0=>not active")->default(0);
            $table->foreign('form_id')->references('id')->on('questionnaire_forms')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaire_form_fields');
    }
};
