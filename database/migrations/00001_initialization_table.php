<?php

use Core\Migration;
use Core\Schema;
use Core\Schema\Blueprint;

return new class extends Migration {
	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('name')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('categories');
	}
};
