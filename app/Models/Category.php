<?php

namespace App\Models;

use Lumin\Databases\Model;

class Category extends Model {
    protected array $fillable = ['name'];

    public function articles() {
        return $this->hasMany('articles', 'category_id');
    }
}
