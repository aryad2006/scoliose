import { useState } from 'react';
import { Head } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { ChevronDownIcon } from '@heroicons/react/24/outline';

interface Lesson {
    id: number;
    title: string;
    type: 'video' | 'text' | 'image' | 'quiz' | 'sim3d';
    order: number;
}

interface Module {
    id: number;
    title: string;
    order: number;
    lessons: Lesson[];
}

interface Course {
    id: number;
    slug: string;
    title: string;
    description?: string;
    level: string;
    is_published: boolean;
}

interface Props {
    course: Course & { modules: Module[] };
    progress?: {
        total_lessons: number;
        completed_lessons: number;
    };
}

export default function CourseShow({ course, progress }: Props) {
    const [expandedModules, setExpandedModules] = useState<number[]>([]);

    const toggleModule = (moduleId: number) => {
        setExpandedModules(prev =>
            prev.includes(moduleId)
                ? prev.filter(id => id !== moduleId)
                : [...prev, moduleId]
        );
    };

    const lessonTypeIcons = {
        video: '🎥',
        text: '📄',
        image: '🖼️',
        quiz: '📝',
        sim3d: '🎮',
    };

    const progressPercent = progress
        ? Math.round((progress.completed_lessons / progress.total_lessons) * 100)
        : 0;

    return (
        <AuthenticatedLayout
            header={
                <div className="flex justify-between items-start">
                    <div>
                        <h2 className="text-xl font-semibold leading-tight text-gray-800">
                            {course.title}
                        </h2>
                        <p className="text-sm text-gray-600 mt-1">{course.description}</p>
                    </div>
                </div>
            }
        >
            <Head title={course.title} />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {/* Progress Section */}
                    {progress && (
                        <div className="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div className="p-6">
                                <h3 className="mb-2 text-lg font-semibold text-gray-900">
                                    Progression
                                </h3>
                                <div className="flex items-center justify-between mb-2">
                                    <span className="text-sm text-gray-600">
                                        {progress.completed_lessons} / {progress.total_lessons} leçons complétées
                                    </span>
                                    <span className="text-lg font-semibold text-blue-600">
                                        {progressPercent}%
                                    </span>
                                </div>
                                <div className="w-full bg-gray-200 rounded-full h-3">
                                    <div
                                        className="bg-blue-600 h-3 rounded-full transition-all"
                                        style={{ width: `${progressPercent}%` }}
                                    />
                                </div>
                            </div>
                        </div>
                    )}

                    {/* Modules and Lessons */}
                    <div className="space-y-4">
                        {course.modules.map(module => (
                            <div
                                key={module.id}
                                className="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                            >
                                <button
                                    onClick={() => toggleModule(module.id)}
                                    className="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition"
                                >
                                    <div className="text-left flex-1">
                                        <h3 className="font-semibold text-gray-900">
                                            Module {module.order}: {module.title}
                                        </h3>
                                        <p className="text-sm text-gray-600 mt-1">
                                            {module.lessons.length} leçon{module.lessons.length !== 1 ? 's' : ''}
                                        </p>
                                    </div>
                                    <ChevronDownIcon
                                        className={`w-5 h-5 text-gray-600 transition-transform ${
                                            expandedModules.includes(module.id)
                                                ? 'transform rotate-180'
                                                : ''
                                        }`}
                                    />
                                </button>

                                {expandedModules.includes(module.id) && (
                                    <div className="border-t border-gray-200">
                                        <div className="divide-y divide-gray-200">
                                            {module.lessons.map(lesson => (
                                                <a
                                                    key={lesson.id}
                                                    href={`/lessons/${lesson.id}`}
                                                    className="block px-6 py-4 hover:bg-blue-50 transition text-sm"
                                                >
                                                    <div className="flex items-center gap-3">
                                                        <span className="text-xl">
                                                            {lessonTypeIcons[lesson.type]}
                                                        </span>
                                                        <span className="text-gray-900">
                                                            Leçon {lesson.order}: {lesson.title}
                                                        </span>
                                                    </div>
                                                </a>
                                            ))}
                                        </div>
                                    </div>
                                )}
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
