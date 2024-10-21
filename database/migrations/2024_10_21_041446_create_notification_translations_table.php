<?php

use App\Models\Notification;
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
        Schema::create('notification_translations', function (Blueprint $table) {
            $table->id();
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->unsignedInteger('notification_id');
            $table->string('locale')->index();
            $table->text('message', 255);
            $table->text('text');
            $table->unique(['notification_id', 'locale']);
            $table->foreignIdFor(Notification::class)
                ->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_translations');
    }
};
