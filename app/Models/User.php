<?php

namespace App\Models;

use Framework\Databases\Model;

class User extends Model {
    protected array $fillable = ['full_name', 'email', 'password'];
}
