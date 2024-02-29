<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['title'];

    
    
    public function meal() {
        return $this->hasOne(Meal::class);
    }
}
