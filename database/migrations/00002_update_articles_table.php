<?php

use Lumin\Databases\Migration;
use Lumin\Schemas\Blueprint;
use Lumin\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('description')->new();
        });
    }

    public function down(): void {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
