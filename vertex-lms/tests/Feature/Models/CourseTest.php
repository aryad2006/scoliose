<?php

namespace Tests\Feature\Models;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_course_can_be_created()
    {
        $course = Course::create([
            'slug' => 'intro-scoliosis',
            'title' => 'Introduction to Scoliosis',
            'description' => 'A comprehensive guide',
            'level' => 'beginner',
            'is_published' => false,
            'order' => 1,
        ]);

        $this->assertDatabaseHas('courses', ['slug' => 'intro-scoliosis']);
        $this->assertTrue($course->exists);
    }

    public function test_course_has_many_modules()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course->id]);

        $this->assertTrue($course->modules->contains($module));
        $this->assertCount(1, $course->modules);
    }

    public function test_course_fillable_fields()
    {
        $data = [
            'slug' => 'ptg-advanced',
            'title' => 'Advanced PTG',
            'description' => 'Advanced techniques',
            'level' => 'advanced',
            'is_published' => true,
            'order' => 2,
        ];

        $course = Course::create($data);

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $course->{$key});
        }
    }

    public function test_course_is_published_casts_to_boolean()
    {
        $course = Course::create([
            'slug' => 'test',
            'title' => 'Test',
            'is_published' => 1,
        ]);

        $this->assertIsBool($course->is_published);
        $this->assertTrue($course->is_published);
    }
}
