<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Ingredient extends Model
{
    use HasFactory, SoftDeletes,Translatable;

    public $translatedAttributes = ['title'];
    
    //define relationship with meals
    public function meals() {
        return $this->hasMany(Meal::class);
    }
}
