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
        Schema::create('questionnaire_form_translations', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->unsignedInteger('questionnaire_form_id');
            $table->string('locale')->index();
            $table->string('title', 255);
            $table->unique(['questionnaire_form_id', 'locale'], 'questionnaire_form_un');
            $table->foreign('questionnaire_form_id', 'questionnaire_form_fk')->references('id')->on('questionnaire_forms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaire_form_translations');
    }
};
