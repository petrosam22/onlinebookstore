<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            // 'image' => 'required|image',
            'name' => 'required|string',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'description'=>'required',
            'quantity'=>'required|integer',
            'category_id'=>'required|integer',
            'price'=>'required|integer',
        ];
    }
}
