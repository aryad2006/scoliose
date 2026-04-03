<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Course::class);
    }

    public function index()
    {
        return Course::with('modules')->paginate(15);
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());
        return response()->json($course, 201);
    }

    public function show(Course $course)
    {
        return $course->load('modules.lessons');
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());
        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->noContent();
    }
}
