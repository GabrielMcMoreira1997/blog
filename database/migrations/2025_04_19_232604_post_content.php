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
        Schema::create('post_content', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('post')->onDelete('cascade');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_content');
    }
};
