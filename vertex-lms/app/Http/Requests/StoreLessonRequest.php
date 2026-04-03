<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Lesson::class);
    }

    public function rules(): array
    {
        return [
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:video,text,image,quiz,sim3d',
            'content' => 'nullable|json',
            'order' => 'integer|min:0',
        ];
    }
}
