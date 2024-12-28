<?php

namespace App\Http\Requests;

use App\Constant\IsActive;
use App\Constant\Level;
use App\Constant\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostCreateRequest extends FormRequest
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
            'author' => 'required',
            'email' => 'required',
            'title' => 'required',
            'contents' => 'required',
            'attachment_hidden' => 'required',
        ];
    }

    public function withValidator($validator): void
    {
        if ($validator->fails()) {
            toastr('Data gagal di validasi', 'error');
        }
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi'
        ];
    }

    public function getAttachment()
    {
        try {
            if ($this->has('attachment')) {
                $file = $this->file('attachment');
                $ext = $file->getClientOriginalExtension();
                $fileFoto = random_int(100000, 999999) . '.' . $ext;
                $destination = 'thumb/' . $fileFoto;
                if (App::environment(['staging', 'production'])) {
                    Storage::disk('s3')->put($destination, $fileFoto);
                    // Storage::disk('s3')->put($destination, file_get_contents($file), 'public');
                } else {
                    Storage::disk('public')->put($destination, file_get_contents($file), 'public');
                }
            } else {
                $fileFoto = $this->attachment_hidden;
            }
            return $fileFoto;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function data()
    {

        $data['post'] = [
            'title' => $this->title,
            'content' => $this->contents,
            'is_active' => IsActive::YES,
            'status' => Status::DRAFT,
            'level' => Level::USER,
            'attachment' => $this->getAttachment(),
        ];
        $data['user'] = [
            'name' => $this->author,
            'email' => $this->email,
        ];
        return $data;
    }
}
