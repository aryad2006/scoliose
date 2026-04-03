<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Course $course): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        if ($user->hasRole('instructor')) {
            return true;
        }
        if ($course->is_published) {
            return true;
        }
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'instructor']);
    }

    public function update(User $user, Course $course): bool
    {
        return $user->hasRole(['admin', 'instructor']);
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->hasRole(['admin', 'instructor']);
    }

    public function restore(User $user, Course $course): bool
    {
        return false;
    }

    public function forceDelete(User $user, Course $course): bool
    {
        return $user->hasRole('admin');
    }
}
