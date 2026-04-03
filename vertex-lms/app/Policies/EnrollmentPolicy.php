<?php

namespace App\Policies;

use App\Models\Enrollment;
use App\Models\User;

class EnrollmentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Enrollment $enrollment): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        // User can view their own enrollment
        if ($user->id === $enrollment->user_id) {
            return true;
        }
        // Instructor can view enrollments in their courses
        if ($user->hasRole('instructor')) {
            return $user->id === $enrollment->course->user_id;
        }
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'instructor', 'student']);
    }

    public function update(User $user, Enrollment $enrollment): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        // Student can only update their own enrollment
        return $user->id === $enrollment->user_id;
    }

    public function delete(User $user, Enrollment $enrollment): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        // Student can unenroll themselves
        return $user->id === $enrollment->user_id;
    }

    public function restore(User $user, Enrollment $enrollment): bool
    {
        return false;
    }

    public function forceDelete(User $user, Enrollment $enrollment): bool
    {
        return $user->hasRole('admin');
    }
}
