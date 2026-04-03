import { Link } from '@inertiajs/react';

interface CourseCardProps {
    id: number;
    slug: string;
    title: string;
    description?: string;
    level: string;
    isPublished: boolean;
    enrollmentStatus?: 'enrolled' | 'available' | null;
    progress?: {
        totalLessons: number;
        completedLessons: number;
    };
    onEnroll?: (courseId: number) => void;
    onUnenroll?: (courseId: number) => void;
}

const levelColors = {
    beginner: 'bg-blue-100 text-blue-800',
    intermediate: 'bg-yellow-100 text-yellow-800',
    advanced: 'bg-red-100 text-red-800',
};

export default function CourseCard({
    id,
    slug,
    title,
    description,
    level,
    isPublished,
    enrollmentStatus,
    progress,
    onEnroll,
    onUnenroll,
}: CourseCardProps) {
    const progressPercent = progress
        ? Math.round((progress.completedLessons / progress.totalLessons) * 100)
        : 0;

    return (
        <div className="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm hover:shadow-md transition-shadow">
            <div className="p-6">
                <div className="flex items-start justify-between mb-2">
                    <h3 className="text-lg font-semibold text-gray-900">{title}</h3>
                    <span className={`px-2 py-1 text-xs font-medium rounded ${levelColors[level as keyof typeof levelColors]}`}>
                        {level}
                    </span>
                </div>

                {description && (
                    <p className="text-sm text-gray-600 mb-4 line-clamp-2">
                        {description}
                    </p>
                )}

                {progress && enrollmentStatus === 'enrolled' && (
                    <div className="mb-4">
                        <div className="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Progression</span>
                            <span>{progress.completedLessons}/{progress.totalLessons}</span>
                        </div>
                        <div className="w-full bg-gray-200 rounded-full h-2">
                            <div
                                className="bg-blue-600 h-2 rounded-full transition-all"
                                style={{ width: `${progressPercent}%` }}
                            />
                        </div>
                    </div>
                )}

                <div className="flex gap-2 mt-4">
                    {enrollmentStatus === 'enrolled' ? (
                        <>
                            <Link
                                href={`/courses/${slug}`}
                                className="flex-1 inline-block text-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition"
                            >
                                Continuer
                            </Link>
                            <button
                                onClick={() => onUnenroll?.(id)}
                                className="px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700 transition"
                            >
                                Se désinscrire
                            </button>
                        </>
                    ) : enrollmentStatus === 'available' ? (
                        <>
                            <Link
                                href={`/courses/${slug}`}
                                className="flex-1 inline-block text-center px-4 py-2 bg-gray-200 text-gray-900 text-sm font-medium rounded hover:bg-gray-300 transition"
                            >
                                Aperçu
                            </Link>
                            <button
                                onClick={() => onEnroll?.(id)}
                                className="flex-1 px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition"
                            >
                                S'inscrire
                            </button>
                        </>
                    ) : null}
                </div>
            </div>
        </div>
    );
}
