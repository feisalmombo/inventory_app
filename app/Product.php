<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Conditon;

class Product extends Model
{
    public function category() {
        return $this->belongsTo(Category::class,'products_category');
     }

     public function condition() {
        return $this->belongsTo(Conditon::class);
     }

       public function Price()
    {
        return $this->hasOne(Price::class);
    }
}
