<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreProgressRequest;
use App\Models\Progress;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Progress::class);
    }

    public function store($lessonId, StoreProgressRequest $request)
    {
        $lesson = Lesson::findOrFail($lessonId);

        $progress = Progress::updateOrCreate(
            ['user_id' => auth()->id(), 'lesson_id' => $lesson->id],
            [
                'completed_at' => $request->completed ? now() : null,
                'score' => $request->score,
                'attempts' => DB::raw('attempts + 1'),
            ]
        );

        return response()->json($progress);
    }

    public function show($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);

        $progress = Progress::where('user_id', auth()->id())
            ->where('lesson_id', $lesson->id)
            ->first();

        return response()->json($progress ?? []);
    }

    public function coursesProgress($courseId)
    {
        $course = Course::with('modules.lessons')->findOrFail($courseId);

        $lessons = $course->modules->flatMap->lessons;
        $progress = Progress::where('user_id', auth()->id())
            ->whereIn('lesson_id', $lessons->pluck('id'))
            ->get()
            ->keyBy('lesson_id');

        return response()->json([
            'total_lessons' => $lessons->count(),
            'completed_lessons' => $progress->where('completed_at')->count(),
            'progress' => $progress,
        ]);
    }
}
