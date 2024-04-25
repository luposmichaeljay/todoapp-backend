<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('todo_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('todo_id');
            $table->foreignId('tag_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('todo_tags');
    }
};
