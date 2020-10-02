<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Store;

class Category extends Model
{
     public function products()
    {
        return $this->hasMany('Product');
    }


     public function store()
    {
        return $this->belongsToMany(Store::class, 'category_store');
    }
}
