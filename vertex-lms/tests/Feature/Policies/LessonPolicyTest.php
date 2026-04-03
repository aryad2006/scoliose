<?php

namespace Tests\Feature\Policies;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LessonPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_any_lesson()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $course = Course::factory()->create(['is_published' => false]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        $this->assertTrue($admin->can('view', $lesson));
    }

    public function test_instructor_can_view_any_lesson()
    {
        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        $this->assertTrue($instructor->can('view', $lesson));
    }

    public function test_student_can_view_lesson_if_enrolled_in_published_course()
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $course = Course::factory()->create(['is_published' => true]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        // Student not enrolled
        $this->assertFalse($student->can('view', $lesson));

        // Student enrolled
        Enrollment::create([
            'user_id' => $student->id,
            'course_id' => $course->id,
        ]);

        $this->assertTrue($student->can('view', $lesson));
    }

    public function test_student_cannot_view_lesson_in_unpublished_course()
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $course = Course::factory()->create(['is_published' => false]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        Enrollment::create([
            'user_id' => $student->id,
            'course_id' => $course->id,
        ]);

        $this->assertFalse($student->can('view', $lesson));
    }

    public function test_only_admin_and_instructor_can_create_lesson()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $student = User::factory()->create();
        $student->assignRole('student');

        $this->assertTrue($admin->can('create', Lesson::class));
        $this->assertTrue($instructor->can('create', Lesson::class));
        $this->assertFalse($student->can('create', Lesson::class));
    }
}
