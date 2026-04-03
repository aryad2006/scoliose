<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class CoursePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_courses_index_page_loads()
    {
        $user = User::factory()->create();
        $user->assignRole('student');

        $course = Course::factory()->create(['is_published' => true]);

        $response = $this->actingAs($user)->get('/courses');

        $response->assertStatus(200);
        $response->assertInertia(fn(Assert $page) =>
            $page
                ->component('Courses/Index')
                ->has('courses', 1)
                ->has('enrolledCourseIds')
        );
    }

    public function test_course_show_page_with_enrollment()
    {
        $user = User::factory()->create();
        $user->assignRole('student');

        $course = Course::factory()->create(['is_published' => true]);
        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        $response = $this->actingAs($user)->get("/courses/{$course->slug}");

        $response->assertStatus(200);
        $response->assertInertia(fn(Assert $page) =>
            $page
                ->component('Courses/Show')
                ->has('course')
                ->has('progress')
        );
    }

    public function test_unpublished_course_not_visible_to_students()
    {
        $user = User::factory()->create();
        $user->assignRole('student');

        $course = Course::factory()->create(['is_published' => false]);

        $response = $this->actingAs($user)->get("/courses/{$course->slug}");

        $response->assertStatus(403);
    }

    public function test_only_published_courses_shown_in_index()
    {
        $user = User::factory()->create();
        $user->assignRole('student');

        Course::factory()->create(['is_published' => true]);
        Course::factory()->create(['is_published' => false]);

        $response = $this->actingAs($user)->get('/courses');

        $response->assertInertia(fn(Assert $page) =>
            $page->has('courses', 1)
        );
    }

    public function test_authenticated_user_required()
    {
        $response = $this->get('/courses');

        $response->assertRedirect('/login');
    }
}
