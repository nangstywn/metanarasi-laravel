<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // dd(request()->all());
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
            'tag' => 'required|unique:tags,name,' . $this->id
        ];
    }

    public function attributes()
    {
        return [
            'tag' => 'tag'
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
            'name' => $this->tag,
            'slug' => Str::slug($this->tag)
        ];
    }
}
