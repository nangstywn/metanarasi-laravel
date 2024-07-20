<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required'
        ];
    }

    public function getAttachment()
    {
        try {
            if ($this->has('attachment')) {
                $file = $this->file('attachment');
                $ext = $file->getClientOriginalExtension();
                $fileFoto = random_int(100000, 999999) . '.' . $ext;
                $destination = 'post/thumb/' . $fileFoto;
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

    public function data(){
        
    }
}
