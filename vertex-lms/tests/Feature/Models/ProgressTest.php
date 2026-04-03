<?php

namespace Tests\Feature\Models;

use App\Models\Lesson;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgressTest extends TestCase
{
    use RefreshDatabase;

    public function test_progress_can_be_created()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();

        $progress = Progress::create([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'completed_at' => now(),
            'score' => 85,
            'attempts' => 1,
        ]);

        $this->assertDatabaseHas('progress', [
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
        ]);
    }

    public function test_progress_belongs_to_user_and_lesson()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $progress = Progress::create([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
        ]);

        $this->assertInstanceOf(User::class, $progress->user);
        $this->assertInstanceOf(Lesson::class, $progress->lesson);
    }

    public function test_progress_completed_at_casts_to_datetime()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();
        $completedAt = now();

        $progress = Progress::create([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'completed_at' => $completedAt,
        ]);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $progress->completed_at);
    }

    public function test_progress_unique_constraint()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();

        Progress::create([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
        ]);

        // Trying to create duplicate should fail
        $this->expectException(\Illuminate\Database\QueryException::class);

        Progress::create([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
        ]);
    }
}
