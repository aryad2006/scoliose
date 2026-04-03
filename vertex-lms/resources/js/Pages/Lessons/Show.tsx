import { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

interface Lesson {
    id: number;
    title: string;
    type: 'video' | 'text' | 'image' | 'quiz' | 'sim3d';
    content?: Record<string, any>;
}

interface Module {
    id: number;
    title: string;
    lessons: Lesson[];
}

interface Props {
    lesson: Lesson & { module: Module };
    progress?: {
        completed_at?: string;
        score?: number;
        attempts: number;
    };
}

export default function LessonShow({ lesson, progress }: Props) {
    const [isCompleting, setIsCompleting] = useState(false);
    const [score, setScore] = useState(progress?.score || 0);

    const handleComplete = () => {
        setIsCompleting(true);
        router.post(`/api/lessons/${lesson.id}/progress`, {
            completed: true,
            score: score,
        }, {
            onFinish: () => setIsCompleting(false),
        });
    };

    const renderContent = () => {
        switch (lesson.type) {
            case 'text':
                return (
                    <div className="prose max-w-none">
                        {lesson.content?.html ? (
                            <div dangerouslySetInnerHTML={{ __html: lesson.content.html }} />
                        ) : (
                            <p>{lesson.content?.text}</p>
                        )}
                    </div>
                );
            case 'video':
                return (
                    <div className="aspect-video bg-gray-900 rounded-lg overflow-hidden">
                        {lesson.content?.url ? (
                            <video controls className="w-full h-full">
                                <source src={lesson.content.url} />
                                Votre navigateur ne supporte pas la balise vidéo.
                            </video>
                        ) : (
                            <div className="flex items-center justify-center h-full text-white">
                                Vidéo non disponible
                            </div>
                        )}
                    </div>
                );
            case 'quiz':
                return (
                    <div className="space-y-6">
                        {lesson.content?.questions?.map((q: any, idx: number) => (
                            <div key={idx} className="border border-gray-200 rounded-lg p-4">
                                <h4 className="font-semibold text-gray-900 mb-3">
                                    Question {idx + 1}: {q.text}
                                </h4>
                                <div className="space-y-2">
                                    {q.options?.map((opt: any, optIdx: number) => (
                                        <label key={optIdx} className="flex items-center">
                                            <input
                                                type="radio"
                                                name={`question-${idx}`}
                                                className="mr-3"
                                            />
                                            {opt}
                                        </label>
                                    ))}
                                </div>
                            </div>
                        ))}
                    </div>
                );
            case 'sim3d':
                return (
                    <div className="aspect-video bg-gray-900 rounded-lg flex items-center justify-center text-white">
                        Simulateur 3D - En développement
                    </div>
                );
            default:
                return <p className="text-gray-600">Format de contenu non supporté</p>;
        }
    };

    return (
        <AuthenticatedLayout
            header={
                <div>
                    <h2 className="text-xl font-semibold leading-tight text-gray-800">
                        {lesson.title}
                    </h2>
                    <p className="text-sm text-gray-600 mt-1">
                        Module: {lesson.module.title}
                    </p>
                </div>
            }
        >
            <Head title={lesson.title} />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6">
                            {/* Content */}
                            <div className="mb-8">
                                {renderContent()}
                            </div>

                            {/* Completion Section */}
                            <div className="border-t border-gray-200 pt-6">
                                {progress?.completed_at ? (
                                    <div className="bg-green-50 border border-green-200 rounded-lg p-4">
                                        <p className="text-green-800">
                                            ✓ Leçon complétée le {new Date(progress.completed_at).toLocaleDateString('fr-FR')}
                                        </p>
                                        {progress.score !== undefined && (
                                            <p className="text-green-800 mt-1">
                                                Score: {progress.score}/100
                                            </p>
                                        )}
                                        <p className="text-green-700 text-sm mt-2">
                                            Tentatives: {progress.attempts}
                                        </p>
                                    </div>
                                ) : (
                                    <div>
                                        {lesson.type === 'quiz' && (
                                            <div className="mb-4">
                                                <label className="block text-sm font-medium text-gray-700 mb-2">
                                                    Score (optionnel): {score}/100
                                                </label>
                                                <input
                                                    type="range"
                                                    min="0"
                                                    max="100"
                                                    value={score}
                                                    onChange={(e) => setScore(parseInt(e.target.value))}
                                                    className="w-full"
                                                />
                                            </div>
                                        )}
                                        <button
                                            onClick={handleComplete}
                                            disabled={isCompleting}
                                            className="w-full px-4 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 disabled:bg-gray-400 transition"
                                        >
                                            {isCompleting ? 'Enregistrement...' : 'Marquer comme complétée'}
                                        </button>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
