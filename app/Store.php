<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Store extends Model
{
    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_store');
    }
}
