<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'sometimes|image',
            'name' => 'sometimes|string',
            'author_id' => 'sometimes',
            'publisher_id' => 'sometimes',
            'description'=>'sometimes',
            'quantity'=>'sometimes|integer',
            'category_id'=>'sometimes',
            'price'=>'sometimes|integer',

        ];
    }
}
