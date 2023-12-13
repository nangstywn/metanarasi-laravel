<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
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
            'category' => 'required|unique:categories,name'
        ];
    }

    public function attributes()
    {
        return [
            'category' => 'kategori'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah ada'
        ];
    }

    public function data()
    {
        return [
            'name' => $this->category,
            'slug' => Str::slug($this->category)
        ];
    }
}
