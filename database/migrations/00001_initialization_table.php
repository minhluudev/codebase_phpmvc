<?php

use Core\Migration;
use Core\Schema;
use Core\Schema\Blueprint;

return new class extends Migration {
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('full_name');
			$table->string('email')->unique();
			$table->string('password');
			$table->timestamps();
		});
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('name')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('users');
		Schema::dropIfExists('categories');
	}
};
