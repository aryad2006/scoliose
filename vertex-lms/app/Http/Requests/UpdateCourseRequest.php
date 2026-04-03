<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('course'));
    }

    public function rules(): array
    {
        return [
            'slug' => 'sometimes|unique:courses,slug,' . $this->route('course')->id . '|string|max:255',
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'level' => 'sometimes|in:beginner,intermediate,advanced',
            'is_published' => 'boolean',
            'order' => 'integer|min:0',
        ];
    }
}
