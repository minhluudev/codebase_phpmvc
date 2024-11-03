<?php

namespace App\Models;

use Lumin\Databases\Model;
use Lumin\Databases\Traits\SoftDeletes;

class User extends Model
{
	use SoftDeletes;

	protected array $fillable = ['full_name', 'email', 'password'];
}
