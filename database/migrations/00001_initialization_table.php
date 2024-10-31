<?php

use Lumin\Databases\Migration;
use Lumin\Schemas\Blueprint;
use Lumin\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', ['nullable' => true]);
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor('categories', 'category_id');
            $table->string('title');
            $table->string('content');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('categories');
    }
};
