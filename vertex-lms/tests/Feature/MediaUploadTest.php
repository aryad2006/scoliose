<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_instructor_can_upload_image_to_lesson()
    {
        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $course = Course::factory()->create(['user_id' => $instructor->id]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        $file = UploadedFile::fake()->image('test.jpg', 100, 100);

        $response = $this->actingAs($instructor)
            ->postJson("/api/lessons/{$lesson->id}/media", [
                'file' => $file,
                'collection' => 'images',
            ]);

        $response->assertCreated();
        $response->assertJsonStructure(['id', 'name', 'url', 'collection']);

        // Verify media was created in database
        $this->assertCount(1, $lesson->fresh()->media);
        $this->assertEquals('images', $lesson->fresh()->media->first()->collection_name);
    }

    public function test_student_cannot_upload_media_to_lesson()
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        $file = UploadedFile::fake()->image('test.jpg');

        $response = $this->actingAs($student)
            ->postJson("/api/lessons/{$lesson->id}/media", [
                'file' => $file,
                'collection' => 'images',
            ]);

        $response->assertForbidden();
    }

    public function test_invalid_file_type_rejected()
    {
        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $course = Course::factory()->create(['user_id' => $instructor->id]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        $file = UploadedFile::fake()->create('test.exe');

        $response = $this->actingAs($instructor)
            ->postJson("/api/lessons/{$lesson->id}/media", [
                'file' => $file,
                'collection' => 'images',
            ]);

        $response->assertUnprocessable();
    }

    public function test_get_lesson_media()
    {
        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $course = Course::factory()->create(['user_id' => $instructor->id]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        $file = UploadedFile::fake()->image('test.jpg');
        $lesson->addMedia($file)->toMediaCollection('images');

        $response = $this->actingAs($instructor)
            ->getJson("/api/lessons/{$lesson->id}/media");

        $response->assertOk();
        $response->assertJsonCount(1);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'url', 'collection', 'size', 'created_at']
        ]);
    }

    public function test_delete_media()
    {
        $instructor = User::factory()->create();
        $instructor->assignRole('instructor');

        $course = Course::factory()->create(['user_id' => $instructor->id]);
        $module = Module::factory()->create(['course_id' => $course->id]);
        $lesson = Lesson::factory()->create(['module_id' => $module->id]);

        $file = UploadedFile::fake()->image('test.jpg');
        $media = $lesson->addMedia($file)->toMediaCollection('images');

        $response = $this->actingAs($instructor)
            ->deleteJson("/api/lessons/{$lesson->id}/media/{$media->id}");

        $response->assertNoContent();
        $this->assertNull($lesson->fresh()->media()->find($media->id));
    }
}
