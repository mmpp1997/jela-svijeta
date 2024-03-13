<?php

namespace App\Rules;

use Closure;
use App\Models\Language;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckLanguage implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $locales = Config::get('translatable.locales');

        if (!in_array($value, $locales)){
            $fail('language ' . $value. ' not in config/translatable.php');
        }

        // if (!Language::where('locale', $value)->exists()) {
        //     $fail('language ' . $value. ' not in languages table');
        // }
    }
}
