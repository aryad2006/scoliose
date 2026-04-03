<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Enrollment::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Enrollment::where('user_id', auth()->id())
            ->with('course.modules.lessons')
            ->active()
            ->paginate();
    }

    public function store($courseId)
    {
        $course = \App\Models\Course::findOrFail($courseId);

        $enrollment = Enrollment::firstOrCreate(
            ['user_id' => auth()->id(), 'course_id' => $course->id],
            ['enrolled_at' => now()]
        );

        return response()->json($enrollment, 201);
    }

    public function destroy($courseId)
    {
        $course = \App\Models\Course::findOrFail($courseId);

        Enrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->delete();

        return response()->noContent();
    }
}
