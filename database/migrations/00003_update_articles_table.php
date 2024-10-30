<?php

use Framework\Databases\Migration;
use Framework\Schemas\Blueprint;
use Framework\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('articles', function (Blueprint $table) {
            $table
                ->string('description', ['size' => 100])
                ->change();
        });
    }

    public function down(): void {
        Schema::table('articles', function (Blueprint $table) {
            $table
                ->string('description')
                ->change();
        });
    }
};
