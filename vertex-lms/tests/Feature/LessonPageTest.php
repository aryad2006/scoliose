<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class LessonPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_enrolled_student_can_view_lesson()
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $course = Course::factory()->create(['is_published' => true]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        Enrollment::create([
            'user_id' => $student->id,
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        $response = $this->actingAs($student)->get("/lessons/{$lesson->id}");

        $response->assertStatus(200);
        $response->assertInertia(fn(Assert $page) =>
            $page
                ->component('Lessons/Show')
                ->has('lesson')
                ->has('progress', null)
        );
    }

    public function test_unenrolled_student_cannot_view_lesson()
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $course = Course::factory()->create(['is_published' => true]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        $response = $this->actingAs($student)->get("/lessons/{$lesson->id}");

        $response->assertStatus(403);
    }

    public function test_instructor_can_view_their_lesson()
    {
        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $course = Course::factory()->create(['user_id' => $instructor->id, 'is_published' => true]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        $response = $this->actingAs($instructor)->get("/lessons/{$lesson->id}");

        $response->assertStatus(200);
    }

    public function test_lesson_shows_student_progress()
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $course = Course::factory()->create(['is_published' => true]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        Enrollment::create([
            'user_id' => $student->id,
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        $student->progress()->create([
            'lesson_id' => $lesson->id,
            'completed_at' => now(),
            'score' => 85,
            'attempts' => 1,
        ]);

        $response = $this->actingAs($student)->get("/lessons/{$lesson->id}");

        $response->assertInertia(fn(Assert $page) =>
            $page
                ->has('progress', fn(Assert $page) =>
                    $page
                        ->has('completed_at')
                        ->where('score', 85)
                        ->where('attempts', 1)
                )
        );
    }

    public function test_authenticated_user_required_for_lesson()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->get("/lessons/{$lesson->id}");

        $response->assertRedirect('/login');
    }
}
