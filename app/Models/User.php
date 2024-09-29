<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
	protected $fillable = [
		'full_name',
		'email',
		'password'
	];
}
