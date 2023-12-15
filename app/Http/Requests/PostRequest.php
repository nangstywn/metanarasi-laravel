<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required',
            'category' => 'required',
            'contents' => 'required',
            'attachment_hidden' => 'required',
        ];
    }

    public function withValidator($validator): void
    {
        if ($validator->fails()) {
            toastr('Data gagal divalidasi', 'error');
        }
    }


    public function attributes()
    {
        return [
            'title' => 'judul',
            'category' => 'kategori',
            'contents' => 'konten',
            'attachment-hidden' => 'thumbnail',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi'
        ];
    }

    public function getAttachment()
    {
        if ($this->has('attachment')) {
            $file = $this->file('attachment');
            $ext = $file->getClientOriginalExtension();
            $fileFoto = random_int(100000, 999999) . '.' . $ext;
            $destination = storage_path('app/public/thumb');
            $file->move($destination, $fileFoto);
        } else {
            $fileFoto = $this->attachment_hidden;
        }
        return $fileFoto;
    }

    public function data()
    {

        $data['post'] = [
            'title' => $this->title,
            'category_id' => $this->category,
            'content' => $this->contents,
            'attachment' => $this->getAttachment(),
        ];
        foreach ($this->tags as $tag) {
            $data['tags'][] = [
                'tag_id' => $tag
            ];
        }
        return $data;
    }
}
