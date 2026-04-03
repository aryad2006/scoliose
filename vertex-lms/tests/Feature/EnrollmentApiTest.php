<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentApiTest extends TestCase
{
    use RefreshDatabase;

    private $student;
    private $course;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = User::factory()->create(['email' => 'student@test.com']);
        $this->student->assignRole('student');

        $this->course = Course::factory()->create(['is_published' => true]);
    }

    public function test_student_can_enroll_in_course()
    {
        $response = $this->actingAs($this->student)
            ->postJson("/api/courses/{$this->course->id}/enroll");

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'user_id',
                'course_id',
                'enrolled_at',
            ]);

        $this->assertDatabaseHas('enrollments', [
            'user_id' => $this->student->id,
            'course_id' => $this->course->id,
        ]);
    }

    public function test_student_cannot_enroll_twice()
    {
        Enrollment::create([
            'user_id' => $this->student->id,
            'course_id' => $this->course->id,
            'enrolled_at' => now(),
        ]);

        $response = $this->actingAs($this->student)
            ->postJson("/api/courses/{$this->course->id}/enroll");

        // Should return existing enrollment (firstOrCreate)
        $response->assertStatus(201);
        $this->assertEquals(1, Enrollment::where('user_id', $this->student->id)->count());
    }

    public function test_student_can_view_enrollments()
    {
        Enrollment::create([
            'user_id' => $this->student->id,
            'course_id' => $this->course->id,
            'enrolled_at' => now(),
        ]);

        $response = $this->actingAs($this->student)
            ->getJson('/api/enrollments');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'course_id',
                    'enrolled_at',
                    'course' => ['id', 'title'],
                ],
            ]);
    }

    public function test_student_can_unenroll()
    {
        Enrollment::create([
            'user_id' => $this->student->id,
            'course_id' => $this->course->id,
            'enrolled_at' => now(),
        ]);

        $response = $this->actingAs($this->student)
            ->deleteJson("/api/courses/{$this->course->id}/unenroll");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('enrollments', [
            'user_id' => $this->student->id,
            'course_id' => $this->course->id,
        ]);
    }

    public function test_enrollment_requires_auth()
    {
        $response = $this->postJson("/api/courses/{$this->course->id}/enroll");

        $response->assertStatus(401);
    }

    public function test_active_enrollment_scope()
    {
        // Create active enrollment
        Enrollment::create([
            'user_id' => $this->student->id,
            'course_id' => $this->course->id,
            'enrolled_at' => now(),
            'expires_at' => now()->addDays(30),
        ]);

        // Create expired enrollment
        $expiredCourse = Course::factory()->create();
        Enrollment::create([
            'user_id' => $this->student->id,
            'course_id' => $expiredCourse->id,
            'enrolled_at' => now()->subDays(60),
            'expires_at' => now()->subDays(30),
        ]);

        $response = $this->actingAs($this->student)
            ->getJson('/api/enrollments');

        $response->assertStatus(200)
            ->assertJsonCount(1); // Only active enrollment
    }
}
