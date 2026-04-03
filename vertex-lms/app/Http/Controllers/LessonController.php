<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Lesson::class);
    }

    public function index($moduleId)
    {
        return \App\Models\Module::findOrFail($moduleId)->lessons()->paginate();
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->validated());
        return response()->json($lesson, 201);
    }

    public function show(Lesson $lesson)
    {
        return $lesson;
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());
        return response()->json($lesson);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return response()->noContent();
    }
}
