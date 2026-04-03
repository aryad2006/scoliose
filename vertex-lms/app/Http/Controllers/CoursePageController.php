<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Inertia;

class CoursePageController extends Controller
{
    /**
     * Display list of courses (Inertia page)
     */
    public function index()
    {
        $user = auth()->user();
        $courses = Course::where('is_published', true)->get();
        $enrolledCourseIds = $user->enrollments()
            ->whereHas('course', fn($q) => $q->where('is_published', true))
            ->pluck('course_id')
            ->toArray();

        return Inertia::render('Courses/Index', [
            'courses' => $courses,
            'enrolledCourseIds' => $enrolledCourseIds,
        ]);
    }

    /**
     * Display a specific course with progress (Inertia page)
     */
    public function show(Course $course)
    {
        // Check if user is enrolled
        $user = auth()->user();
        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->exists();

        if (!$course->is_published && !$user->can('view', $course)) {
            abort(403);
        }

        $courseData = $course->load('modules.lessons')->toArray();

        $progress = null;
        if ($isEnrolled) {
            $lessons = $course->modules->flatMap->lessons;
            $completed = $user->progress()
                ->whereIn('lesson_id', $lessons->pluck('id'))
                ->where('completed_at', '!=', null)
                ->count();

            $progress = [
                'total_lessons' => $lessons->count(),
                'completed_lessons' => $completed,
            ];
        }

        return Inertia::render('Courses/Show', [
            'course' => $courseData,
            'progress' => $progress,
        ]);
    }
}
