<?php

namespace App\Policies;

use App\Models\Progress;
use App\Models\User;

class ProgressPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Progress $progress): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        // User can view their own progress
        if ($user->id === $progress->user_id) {
            return true;
        }
        // Instructor can view progress for their course lessons
        if ($user->hasRole('instructor')) {
            return $user->id === $progress->lesson->module->course->user_id;
        }
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'student']);
    }

    public function update(User $user, Progress $progress): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        // Student can only update their own progress
        return $user->id === $progress->user_id;
    }

    public function delete(User $user, Progress $progress): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        // Student can delete their own progress
        return $user->id === $progress->user_id;
    }

    public function restore(User $user, Progress $progress): bool
    {
        return false;
    }

    public function forceDelete(User $user, Progress $progress): bool
    {
        return $user->hasRole('admin');
    }
}
