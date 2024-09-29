<?php

namespace Core;

abstract class Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	abstract public function up();

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	abstract public function down();
}
