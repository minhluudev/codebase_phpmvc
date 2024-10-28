<?php

namespace App\Models;

use Framework\Databases\Model;
use Framework\Databases\Traits\SoftDeletes;

class User extends Model {
    use SoftDeletes;

    protected array $fillable = ['full_name', 'email', 'password'];
}
