<?php

namespace App\Rules;

use Closure;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckCategory implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $category=Str::lower($value);
        
        if($category!='null' && $category!='!null' && !is_numeric(trim($category))){
            $fail('invalid input ' .$category. ' for category');
        }
        else if(is_numeric(trim($category)) && !Category::where('id', $category)->exists()){
            $fail('CategoryId ' . $category . ' is not in categories table');
        }
    }
}
