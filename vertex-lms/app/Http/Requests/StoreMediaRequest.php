<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->can('update', $this->route('lesson'));
    }

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4,webm,pdf|max:102400', // 100MB
            'collection' => 'required|in:images,videos,documents',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Un fichier est requis.',
            'file.file' => 'Le fichier doit être un fichier valide.',
            'file.mimes' => 'Le fichier doit être : jpg, jpeg, png, gif, webp, mp4, webm, pdf.',
            'file.max' => 'Le fichier ne doit pas dépasser 100MB.',
            'collection.required' => 'La collection est requise.',
            'collection.in' => 'La collection doit être : images, videos, documents.',
        ];
    }
}
