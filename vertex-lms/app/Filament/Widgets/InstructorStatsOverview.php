<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Progress;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class InstructorStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();

        // Vérifier si l'utilisateur est instructeur
        if (!$user->hasRole('instructor')) {
            return [];
        }

        // Statistiques des cours de l'instructeur
        $coursesCount = Course::where('user_id', $user->id)->count();
        $totalEnrollments = Enrollment::whereIn(
            'course_id',
            Course::where('user_id', $user->id)->pluck('id')
        )->count();

        $totalCompletions = Progress::whereIn(
            'lesson_id',
            DB::table('lessons')
                ->join('modules', 'lessons.module_id', '=', 'modules.id')
                ->join('courses', 'modules.course_id', '=', 'courses.id')
                ->where('courses.user_id', $user->id)
                ->pluck('lessons.id')
        )
            ->whereNotNull('completed_at')
            ->count();

        return [
            Stat::make(
                label: 'Formations créées',
                value: $coursesCount,
            )
                ->icon('heroicon-o-bookmark')
                ->color('primary'),
            Stat::make(
                label: 'Apprenants inscrits',
                value: $totalEnrollments,
            )
                ->icon('heroicon-o-user-group')
                ->color('success'),
            Stat::make(
                label: 'Leçons complétées',
                value: $totalCompletions,
            )
                ->icon('heroicon-o-check-circle')
                ->color('info'),
        ];
    }
}
