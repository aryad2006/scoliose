<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Course::class);
    }

    public function rules(): array
    {
        return [
            'slug' => 'required|unique:courses|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'required|in:beginner,intermediate,advanced',
            'is_published' => 'boolean',
            'order' => 'integer|min:0',
        ];
    }
}
