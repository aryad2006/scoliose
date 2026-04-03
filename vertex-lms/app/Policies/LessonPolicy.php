<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LessonPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Lesson $lesson): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        if ($user->hasRole('instructor')) {
            return true;
        }
        // Student can view if course is published and enrolled
        if ($lesson->module->course->is_published && $user->enrollments->contains('course_id', $lesson->module->course_id)) {
            return true;
        }
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'instructor']);
    }

    public function update(User $user, Lesson $lesson): bool
    {
        return $user->hasRole('admin') || $user->hasRole('instructor');
    }

    public function delete(User $user, Lesson $lesson): bool
    {
        return $user->hasRole('admin') || $user->hasRole('instructor');
    }

    public function restore(User $user, Lesson $lesson): bool
    {
        return false;
    }

    public function forceDelete(User $user, Lesson $lesson): bool
    {
        return $user->hasRole('admin');
    }
}
