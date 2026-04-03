<?php

namespace Tests\Feature\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoursePolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_any_course()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $course = Course::factory()->create(['is_published' => false]);

        $this->assertTrue($admin->can('view', $course));
    }

    public function test_instructor_can_view_any_course()
    {
        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $course = Course::factory()->create(['is_published' => false]);

        $this->assertTrue($instructor->can('view', $course));
    }

    public function test_student_can_only_view_published_course()
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $publishedCourse = Course::factory()->create(['is_published' => true]);
        $unpublishedCourse = Course::factory()->create(['is_published' => false]);

        $this->assertTrue($student->can('view', $publishedCourse));
        $this->assertFalse($student->can('view', $unpublishedCourse));
    }

    public function test_only_admin_and_instructor_can_create_course()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $student = User::factory()->create();
        $student->assignRole('student');

        $this->assertTrue($admin->can('create', Course::class));
        $this->assertTrue($instructor->can('create', Course::class));
        $this->assertFalse($student->can('create', Course::class));
    }

    public function test_admin_can_update_any_course()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $course = Course::factory()->create();

        $this->assertTrue($admin->can('update', $course));
    }

    public function test_student_cannot_delete_course()
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $course = Course::factory()->create();

        $this->assertFalse($student->can('delete', $course));
    }
}
