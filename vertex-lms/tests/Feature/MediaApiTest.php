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

class MediaApiTest extends TestCase
{
    use RefreshDatabase;

    private $instructor;
    private $lesson;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        $this->instructor = User::factory()->create(['email' => 'instructor@test.com']);
        $this->instructor->assignRole('instructor');

        $course = Course::factory()->create(['user_id' => $this->instructor->id]);
        $module = Module::factory()->for($course)->create();
        $this->lesson = Lesson::factory()->for($module)->create();
    }

    public function test_instructor_can_upload_media_to_lesson()
    {
        $file = UploadedFile::fake()->image('course-banner.jpg');

        $response = $this->actingAs($this->instructor)
            ->postJson("/api/lessons/{$this->lesson->id}/media", [
                'file' => $file,
                'collection' => 'images',
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'url',
                'collection',
            ]);
    }

    public function test_media_collection_validation()
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $response = $this->actingAs($this->instructor)
            ->postJson("/api/lessons/{$this->lesson->id}/media", [
                'file' => $file,
                'collection' => 'invalid_collection',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['collection']);
    }

    public function test_media_file_type_validation()
    {
        $file = UploadedFile::fake()->create('script.exe', 100);

        $response = $this->actingAs($this->instructor)
            ->postJson("/api/lessons/{$this->lesson->id}/media", [
                'file' => $file,
                'collection' => 'images',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['file']);
    }

    public function test_media_file_size_validation()
    {
        $file = UploadedFile::fake()->image('large-file.jpg', 200000); // > 100MB

        $response = $this->actingAs($this->instructor)
            ->postJson("/api/lessons/{$this->lesson->id}/media", [
                'file' => $file,
                'collection' => 'images',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['file']);
    }

    public function test_instructor_can_list_lesson_media()
    {
        // Create media files
        $file1 = UploadedFile::fake()->image('image1.jpg');
        $file2 = UploadedFile::fake()->image('image2.png');

        $this->actingAs($this->instructor)
            ->postJson("/api/lessons/{$this->lesson->id}/media", [
                'file' => $file1,
                'collection' => 'images',
            ]);

        $this->actingAs($this->instructor)
            ->postJson("/api/lessons/{$this->lesson->id}/media", [
                'file' => $file2,
                'collection' => 'images',
            ]);

        $response = $this->actingAs($this->instructor)
            ->getJson("/api/lessons/{$this->lesson->id}/media");

        $response->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'url',
                    'collection',
                    'size',
                    'created_at',
                ],
            ]);
    }

    public function test_instructor_can_delete_media()
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $uploadResponse = $this->actingAs($this->instructor)
            ->postJson("/api/lessons/{$this->lesson->id}/media", [
                'file' => $file,
                'collection' => 'images',
            ]);

        $mediaId = $uploadResponse->json('id');

        $deleteResponse = $this->actingAs($this->instructor)
            ->deleteJson("/api/lessons/{$this->lesson->id}/media/{$mediaId}");

        $deleteResponse->assertStatus(204);
    }

    public function test_only_authenticated_users_can_upload_media()
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $response = $this->postJson("/api/lessons/{$this->lesson->id}/media", [
            'file' => $file,
            'collection' => 'images',
        ]);

        $response->assertStatus(401);
    }

    public function test_student_cannot_upload_media()
    {
        $student = User::factory()->create(['email' => 'student@test.com']);
        $student->assignRole('student');

        $file = UploadedFile::fake()->image('test.jpg');

        $response = $this->actingAs($student)
            ->postJson("/api/lessons/{$this->lesson->id}/media", [
                'file' => $file,
                'collection' => 'images',
            ]);

        // StoreMediaRequest checks authorization
        $response->assertStatus(403);
    }
}
