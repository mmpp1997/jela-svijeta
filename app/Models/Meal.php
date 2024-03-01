<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Meal extends Model
{
    //meal model uses factory for data fill, soft deletes 
    //and multiple translations
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['title', 'description'];

    //define relation with meal category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //define relation with meal tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //define relation with meal ingredients
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
