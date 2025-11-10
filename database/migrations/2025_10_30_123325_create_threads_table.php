<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('threads', function (Blueprint $table) {
        $table->id(); // Auto-incrementing ID
        $table->string('title'); // Thread title
        $table->text('body'); // Thread content
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to users table
        $table->foreignId('topic_id')->constrained()->onDelete('cascade'); // Link to topics table
        $table->timestamps(); // created_at and updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threads');
    }
};