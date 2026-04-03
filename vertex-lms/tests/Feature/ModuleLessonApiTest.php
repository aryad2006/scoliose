<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleLessonApiTest extends TestCase
{
    use RefreshDatabase;

    private $instructor;
    private $course;

    protected function setUp(): void
    {
        parent::setUp();

        $this->instructor = User::factory()->create(['email' => 'instructor@test.com']);
        $this->instructor->assignRole('instructor');

        $this->course = Course::factory()->create(['user_id' => $this->instructor->id]);
    }

    public function test_instructor_can_create_module()
    {
        $data = [
            'course_id' => $this->course->id,
            'title' => 'Module 1: Basics',
            'order' => 1,
        ];

        $response = $this->actingAs($this->instructor)
            ->postJson("/api/courses/{$this->course->id}/modules", $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'course_id',
                'title',
                'order',
            ]);

        $this->assertDatabaseHas('modules', ['title' => 'Module 1: Basics']);
    }

    public function test_instructor_can_list_course_modules()
    {
        Module::factory()->for($this->course)->count(3)->create();

        $response = $this->actingAs($this->instructor)
            ->getJson("/api/courses/{$this->course->id}/modules");

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'lessons' => [
                        '*' => ['id', 'title'],
                    ],
                ],
            ]);
    }

    public function test_instructor_can_update_module()
    {
        $module = Module::factory()->for($this->course)->create();

        $response = $this->actingAs($this->instructor)
            ->patchJson("/api/modules/{$module->id}", [
                'title' => 'Updated Module Title',
            ]);

        $response->assertStatus(200)
            ->assertJson(['title' => 'Updated Module Title']);
    }

    public function test_instructor_can_delete_module()
    {
        $module = Module::factory()->for($this->course)->create();

        $response = $this->actingAs($this->instructor)
            ->deleteJson("/api/modules/{$module->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('modules', ['id' => $module->id]);
    }

    public function test_instructor_can_create_lesson()
    {
        $module = Module::factory()->for($this->course)->create();

        $data = [
            'module_id' => $module->id,
            'title' => 'Lesson 1: Introduction',
            'type' => 'text',
            'content' => json_encode(['body' => 'Introduction content']),
            'order' => 1,
        ];

        $response = $this->actingAs($this->instructor)
            ->postJson("/api/modules/{$module->id}/lessons", $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'module_id',
                'title',
                'type',
                'order',
            ]);

        $this->assertDatabaseHas('lessons', ['title' => 'Lesson 1: Introduction']);
    }

    public function test_instructor_can_list_module_lessons()
    {
        $module = Module::factory()->for($this->course)->create();
        Lesson::factory()->for($module)->count(2)->create();

        $response = $this->actingAs($this->instructor)
            ->getJson("/api/modules/{$module->id}/lessons");

        $response->assertStatus(200)
            ->assertJsonCount(2);
    }

    public function test_instructor_can_update_lesson()
    {
        $module = Module::factory()->for($this->course)->create();
        $lesson = Lesson::factory()->for($module)->create();

        $response = $this->actingAs($this->instructor)
            ->patchJson("/api/lessons/{$lesson->id}", [
                'title' => 'Updated Lesson',
            ]);

        $response->assertStatus(200)
            ->assertJson(['title' => 'Updated Lesson']);
    }

    public function test_instructor_can_delete_lesson()
    {
        $module = Module::factory()->for($this->course)->create();
        $lesson = Lesson::factory()->for($module)->create();

        $response = $this->actingAs($this->instructor)
            ->deleteJson("/api/lessons/{$lesson->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('lessons', ['id' => $lesson->id]);
    }

    public function test_lesson_type_enum_validation()
    {
        $module = Module::factory()->for($this->course)->create();

        $data = [
            'module_id' => $module->id,
            'title' => 'Video Lesson',
            'type' => 'invalid_type', // Invalid type
            'order' => 1,
        ];

        $response = $this->actingAs($this->instructor)
            ->postJson("/api/modules/{$module->id}/lessons", $data);

        // Should fail validation
        $response->assertStatus(422);
    }
}
