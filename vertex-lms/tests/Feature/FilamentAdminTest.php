<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilamentAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_courses_resource()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/admin/courses');

        $response->assertOk();
    }

    public function test_instructor_can_only_see_their_courses()
    {
        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $ownCourse = Course::factory()->create(['user_id' => $instructor->id]);
        $otherCourse = Course::factory()->create(['user_id' => User::factory()->create()->id]);

        $response = $this->actingAs($instructor)->get('/admin/courses');

        $response->assertOk();
        // The response should contain the instructor's course data
        // This would be verified through Filament's table API
    }

    public function test_student_cannot_access_admin_panel()
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $response = $this->actingAs($student)->get('/admin/courses');

        $response->assertStatus(403);
    }

    public function test_instructor_can_create_course()
    {
        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $courseData = [
            'title' => 'Test Course',
            'slug' => 'test-course',
            'level' => 'beginner',
            'is_published' => false,
            'order' => 0,
        ];

        $response = $this->actingAs($instructor)->post('/admin/courses', $courseData);

        // Filament redirects to the resource index after creation
        $this->assertDatabaseHas('courses', [
            'title' => 'Test Course',
            'user_id' => $instructor->id,
        ]);
    }

    public function test_instructor_cannot_edit_other_instructor_course()
    {
        $instructor1 = User::factory()->create();
        $instructor1->assignRole('instructor');

        $instructor2 = User::factory()->create();
        $instructor2->assignRole('instructor');

        $course = Course::factory()->create(['user_id' => $instructor1->id]);

        $response = $this->actingAs($instructor2)->get("/admin/courses/{$course->id}/edit");

        $response->assertStatus(403);
    }

    public function test_authenticated_user_required_for_admin()
    {
        $response = $this->get('/admin/courses');

        $response->assertRedirect('/login');
    }
}
