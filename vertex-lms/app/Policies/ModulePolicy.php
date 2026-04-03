<?php

namespace App\Policies;

use App\Models\Module;
use App\Models\User;

class ModulePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Module $module): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        if ($user->hasRole('instructor')) {
            return true;
        }
        // Student can view if course is published and enrolled
        $course = $module->course;
        if (!$course->is_published) {
            return false;
        }
        return \App\Models\Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->exists();
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'instructor']);
    }

    public function update(User $user, Module $module): bool
    {
        return $user->hasRole('admin') || $user->hasRole('instructor');
    }

    public function delete(User $user, Module $module): bool
    {
        return $user->hasRole('admin') || $user->hasRole('instructor');
    }

    public function restore(User $user, Module $module): bool
    {
        return false;
    }

    public function forceDelete(User $user, Module $module): bool
    {
        return $user->hasRole('admin');
    }
}
