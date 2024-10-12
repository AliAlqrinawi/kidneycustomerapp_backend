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
        Schema::create('section_text_translations', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->unsignedInteger('section_text_id');
            $table->string('locale')->index();
            $table->string('title', 255)->nullable();
            $table->text('text')->nullable();
            $table->unique(['section_text_id', 'locale'], 'section_text_un');
            $table->foreign('section_text_id', 'section_text_fk')->references('id')
                ->on('section_texts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_text_translations');
    }
};
