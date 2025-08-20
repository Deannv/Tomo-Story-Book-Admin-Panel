<?php

use App\Enums\Interaction;
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
        Schema::create('scenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained('stories');
            $table->string('image')->nullable();
            $table->string('hint')->nullable();
            $table->text('content');
            $table->string('interaction_hint')->nullable();
            $table->enum('interaction', [
                Interaction::TalkBack->value,
                Interaction::Soundboard->value,
            ])->nullable();
            $table->string('soundboard')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scenes');
    }
};
