<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseApiTest extends TestCase
{
    use RefreshDatabase;

    private $instructor;
    private $student;

    protected function setUp(): void
    {
        parent::setUp();

        $this->instructor = User::factory()->create(['email' => 'instructor@test.com']);
        $this->instructor->assignRole('instructor');

        $this->student = User::factory()->create(['email' => 'student@test.com']);
        $this->student->assignRole('student');
    }

    public function test_instructor_can_create_course()
    {
        $data = [
            'title' => 'Advanced Scoliosis Surgery',
            'description' => 'In-depth surgical techniques',
            'level' => 'advanced',
            'is_published' => false,
        ];

        $response = $this->actingAs($this->instructor)
            ->postJson('/api/courses', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'title',
                'description',
                'level',
                'is_published',
                'slug',
            ]);

        $this->assertDatabaseHas('courses', ['title' => 'Advanced Scoliosis Surgery']);
    }

    public function test_student_cannot_create_course()
    {
        $data = [
            'title' => 'Test Course',
            'description' => 'Test',
            'level' => 'beginner',
        ];

        $response = $this->actingAs($this->student)
            ->postJson('/api/courses', $data);

        $response->assertStatus(403);
    }

    public function test_instructor_can_update_own_course()
    {
        $course = Course::factory()->create(['user_id' => $this->instructor->id]);

        $response = $this->actingAs($this->instructor)
            ->patchJson("/api/courses/{$course->id}", [
                'title' => 'Updated Title',
            ]);

        $response->assertStatus(200)
            ->assertJson(['title' => 'Updated Title']);
    }

    public function test_instructor_cannot_update_others_course()
    {
        $otherInstructor = User::factory()->create();
        $otherInstructor->assignRole('instructor');

        $course = Course::factory()->create(['user_id' => $this->instructor->id]);

        $response = $this->actingAs($otherInstructor)
            ->patchJson("/api/courses/{$course->id}", [
                'title' => 'Hacked Title',
            ]);

        $response->assertStatus(403);
    }

    public function test_instructor_can_delete_course()
    {
        $course = Course::factory()->create(['user_id' => $this->instructor->id]);

        $response = $this->actingAs($this->instructor)
            ->deleteJson("/api/courses/{$course->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }

    public function test_course_index_requires_auth()
    {
        $response = $this->getJson('/api/courses');

        $response->assertStatus(401);
    }

    public function test_course_with_modules_loads()
    {
        $course = Course::factory()
            ->has(\App\Models\Module::factory()->count(2))
            ->create();

        $response = $this->actingAs($this->student)
            ->getJson("/api/courses/{$course->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'modules' => [
                    '*' => ['id', 'title'],
                ],
            ]);
    }
}
