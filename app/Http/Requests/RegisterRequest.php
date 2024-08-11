<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'role'=>'required',
            'name'=>'required',
            'profession'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'book_name'=>'required',
            'book_page'=>'required',
            'book_genre'=>'required',
            'book_status'=>'required',
            'book_rating'=>'required',
            'comment'=>'required',
        ];
    }
}
