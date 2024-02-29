<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Meal extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['title','description'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
    public function calculate_status()
    {
        dd("we are here");
        
    }

}
