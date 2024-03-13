<?php

namespace App\Rules;

use App\Models\Meal;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckWith implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $properties = explode(',', $value);
        foreach ($properties as $property) {
            if (!method_exists(Meal::class, $property)) {
                $fail('undefined Meal relationship ' . $property);
            }
        }
    }
}
