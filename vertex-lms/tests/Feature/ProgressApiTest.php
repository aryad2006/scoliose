<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgressApiTest extends TestCase
{
    use RefreshDatabase;

    private $student;
    private $lesson;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = User::factory()->create(['email' => 'student@test.com']);
        $this->student->assignRole('student');

        $course = Course::factory()->create(['is_published' => true]);
        $module = Module::factory()->for($course)->create();
        $this->lesson = Lesson::factory()->for($module)->create();

        Enrollment::create([
            'user_id' => $this->student->id,
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);
    }

    public function test_student_can_record_progress()
    {
        $data = [
            'completed' => true,
            'score' => 95,
        ];

        $response = $this->actingAs($this->student)
            ->postJson("/api/lessons/{$this->lesson->id}/progress", $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'user_id',
                'lesson_id',
                'completed_at',
                'score',
                'attempts',
            ])
            ->assertJson([
                'score' => 95,
            ]);

        $this->assertDatabaseHas('progress', [
            'user_id' => $this->student->id,
            'lesson_id' => $this->lesson->id,
            'score' => 95,
        ]);
    }

    public function test_student_can_view_lesson_progress()
    {
        Progress::create([
            'user_id' => $this->student->id,
            'lesson_id' => $this->lesson->id,
            'score' => 85,
            'completed_at' => now(),
        ]);

        $response = $this->actingAs($this->student)
            ->getJson("/api/lessons/{$this->lesson->id}/progress");

        $response->assertStatus(200)
            ->assertJson([
                'score' => 85,
            ]);
    }

    public function test_student_can_view_course_progress()
    {
        $course = $this->lesson->module->course;

        Progress::create([
            'user_id' => $this->student->id,
            'lesson_id' => $this->lesson->id,
            'score' => 85,
            'completed_at' => now(),
        ]);

        $response = $this->actingAs($this->student)
            ->getJson("/api/courses/{$course->id}/progress");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'total_lessons',
                'completed_lessons',
                'progress',
            ])
            ->assertJson([
                'total_lessons' => 1,
                'completed_lessons' => 1,
            ]);
    }

    public function test_progress_tracks_attempts()
    {
        $this->actingAs($this->student)
            ->postJson("/api/lessons/{$this->lesson->id}/progress", [
                'score' => 70,
            ]);

        $this->actingAs($this->student)
            ->postJson("/api/lessons/{$this->lesson->id}/progress", [
                'score' => 85,
            ]);

        $progress = Progress::where('user_id', $this->student->id)
            ->where('lesson_id', $this->lesson->id)
            ->first();

        $this->assertEquals(2, $progress->attempts);
        $this->assertEquals(85, $progress->score); // Last score
    }

    public function test_progress_requires_auth()
    {
        $response = $this->postJson(
            "/api/lessons/{$this->lesson->id}/progress",
            ['score' => 90]
        );

        $response->assertStatus(401);
    }

    public function test_student_can_view_only_own_progress()
    {
        $otherStudent = User::factory()->create();
        $otherStudent->assignRole('student');

        Progress::create([
            'user_id' => $this->student->id,
            'lesson_id' => $this->lesson->id,
            'score' => 85,
        ]);

        // Other student tries to view this student's progress
        $response = $this->actingAs($otherStudent)
            ->getJson("/api/lessons/{$this->lesson->id}/progress");

        $response->assertStatus(200)
            ->assertJson([]); // Empty, no progress found for other student
    }
}
