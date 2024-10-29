<?php

namespace App\Models;

use Framework\Databases\Model;

class Article extends Model {
    protected array $fillable = ['name'];

    public function category() {
        return $this->hasOne('categories', 'category_id');
    }
}
