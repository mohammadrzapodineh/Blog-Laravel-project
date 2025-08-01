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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', column: 'id')->cascadeOnDelete();
            $table->string(column: 'title');
            $table->string('category')->nullable();
            $table->string('text');
            $table->integer('views')->nullable()->default(0);
            $table->string('slug'); // Field name same as your `saveSlugsTo`
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');

    }
};
