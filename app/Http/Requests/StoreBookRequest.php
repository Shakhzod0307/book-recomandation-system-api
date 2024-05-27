<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            "genre"=>"nullable",
            'new_genre'=>'nullable',
            "author"=>"nullable",
            "new_author"=>"nullable",
            "title"=>"required",
            "image"=>"required",
            "page_number"=>"required",
            "description"=>"required",
        ];
    }
}
