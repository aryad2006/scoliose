<?php

namespace Tests\Feature\Models;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_enrollment_can_be_created()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();

        $enrollment = Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        $this->assertDatabaseHas('enrollments', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);
    }

    public function test_enrollment_belongs_to_user_and_course()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $enrollment = Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        $this->assertInstanceOf(User::class, $enrollment->user);
        $this->assertInstanceOf(Course::class, $enrollment->course);
    }

    public function test_enrollment_active_scope()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();

        // Active enrollment (no expires_at)
        $active = Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'expires_at' => null,
        ]);

        // Expired enrollment
        $expired = Enrollment::create([
            'user_id' => User::factory()->create()->id,
            'course_id' => $course->id,
            'expires_at' => now()->subDay(),
        ]);

        $activeEnrollments = Enrollment::active()->get();

        $this->assertTrue($activeEnrollments->contains($active));
        $this->assertFalse($activeEnrollments->contains($expired));
    }

    public function test_enrollment_unique_constraint()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        // Trying to create duplicate should fail
        $this->expectException(\Illuminate\Database\QueryException::class);

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);
    }
}
