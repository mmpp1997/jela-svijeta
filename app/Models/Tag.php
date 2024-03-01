<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Tag extends Model
{
    use HasFactory, SoftDeletes, Translatable;
    
    public $translatedAttributes = ['title'];
    
    //define relationship with meals
    public function meals()
    {
        return $this->belongsToMany(Meal::class);
    }
}
