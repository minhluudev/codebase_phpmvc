<?php

use Lumin\Databases\Migration;
use Lumin\Schemas\Blueprint;
use Lumin\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('full_name');
			$table->string('email')->unique();
			$table->string('password');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('users');
	}
};
