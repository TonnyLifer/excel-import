<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'id' => ['required','numeric'],
            'artikul' => ['required','string'],
            'nomenklatura' => ['required','string'],
            'ed_izm' => ['required','string'],
            'kol' => ['required','string'],
            'cena_za_st' => ['required','string'],
        ];
    }
}
