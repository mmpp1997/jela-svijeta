<?php

namespace App\Http\Requests;

use App\Rules\CheckTags;
use App\Rules\CheckWith;
use App\Rules\CheckCategory;
use App\Rules\CheckLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'per_page' => 'sometimes|numeric|gt:0',
            'page' => 'sometimes|numeric|gt:0',
            'category' => ['sometimes','string',new CheckCategory],
            'tags' => ['sometimes','string',new CheckTags],
            'with' => ['sometimes','string',new CheckWith],
            'lang' => ['required','string','min:2',new CheckLanguage],
            'diff_time' => 'sometimes|numeric|gt:0',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
