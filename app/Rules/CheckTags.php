<?php

namespace App\Rules;

use Closure;
use App\Models\Tag;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckTags implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tags = explode(',', $value);
        foreach ($tags as $tag) {
            // check if tag is numeric or if its id is in tags table
            if (!is_numeric(trim($tag))) {
                $fail($tag . ' is not num tag value');
            }
            else if(!Tag::where('id', $tag)->exists()){
                $fail('tag with id ' .$tag. ' is not in tags table');
            }
        }
    }
}
