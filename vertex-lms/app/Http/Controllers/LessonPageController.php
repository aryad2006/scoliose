<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Inertia\Inertia;

class LessonPageController extends Controller
{
    /**
     * Display lesson content (Inertia page)
     */
    public function show(Lesson $lesson)
    {
        $user = auth()->user();

        // Check if user can view this lesson
        $canView = $user->can('view', $lesson);
        if (!$canView) {
            abort(403);
        }

        $lessonData = $lesson->load('module.course')->toArray();

        // Get user's progress on this lesson
        $progress = $user->progress()
            ->where('lesson_id', $lesson->id)
            ->first();

        return Inertia::render('Lessons/Show', [
            'lesson' => $lessonData,
            'progress' => $progress ? [
                'completed_at' => $progress->completed_at,
                'score' => $progress->score,
                'attempts' => $progress->attempts,
            ] : null,
        ]);
    }
}
