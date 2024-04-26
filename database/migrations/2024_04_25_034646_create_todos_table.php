<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->tinyInteger('priority');
            $table->tinyInteger('status');
            $table->foreignId('user_id');
            $table->timestamp('due_date')->nullable();
            $table->timestamp('date_completed')->nullable();
            $table->timestamp('archived')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
