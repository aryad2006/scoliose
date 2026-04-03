import { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import CourseCard from '@/Components/CourseCard';

interface Course {
    id: number;
    slug: string;
    title: string;
    description?: string;
    level: 'beginner' | 'intermediate' | 'advanced';
    is_published: boolean;
    is_enrolled?: boolean;
}

interface Props {
    courses: Course[];
    enrolledCourseIds: number[];
}

export default function CoursesIndex({ courses, enrolledCourseIds }: Props) {
    const [loading, setLoading] = useState(false);

    const handleEnroll = (courseId: number) => {
        setLoading(true);
        router.post(`/api/courses/${courseId}/enroll`, {}, {
            onFinish: () => setLoading(false),
        });
    };

    const handleUnenroll = (courseId: number) => {
        if (confirm('Êtes-vous sûr de vouloir vous désinscrire de ce cours ?')) {
            setLoading(true);
            router.delete(`/api/courses/${courseId}/unenroll`, {
                onFinish: () => setLoading(false),
            });
        }
    };

    const enrolledCourses = courses.filter(c => enrolledCourseIds.includes(c.id));
    const availableCourses = courses.filter(c => !enrolledCourseIds.includes(c.id) && c.is_published);

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Formations
                </h2>
            }
        >
            <Head title="Formations" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {/* Enrolled Courses */}
                    {enrolledCourses.length > 0 && (
                        <div className="mb-12">
                            <h3 className="mb-4 text-lg font-semibold text-gray-900">
                                Mes formations ({enrolledCourses.length})
                            </h3>
                            <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                                {enrolledCourses.map(course => (
                                    <CourseCard
                                        key={course.id}
                                        id={course.id}
                                        slug={course.slug}
                                        title={course.title}
                                        description={course.description}
                                        level={course.level}
                                        isPublished={course.is_published}
                                        enrollmentStatus="enrolled"
                                        onUnenroll={handleUnenroll}
                                    />
                                ))}
                            </div>
                        </div>
                    )}

                    {/* Available Courses */}
                    {availableCourses.length > 0 && (
                        <div>
                            <h3 className="mb-4 text-lg font-semibold text-gray-900">
                                Formations disponibles ({availableCourses.length})
                            </h3>
                            <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                                {availableCourses.map(course => (
                                    <CourseCard
                                        key={course.id}
                                        id={course.id}
                                        slug={course.slug}
                                        title={course.title}
                                        description={course.description}
                                        level={course.level}
                                        isPublished={course.is_published}
                                        enrollmentStatus="available"
                                        onEnroll={handleEnroll}
                                    />
                                ))}
                            </div>
                        </div>
                    )}

                    {courses.length === 0 && (
                        <div className="bg-white rounded-lg shadow-sm p-6 text-center">
                            <p className="text-gray-600">Aucune formation disponible pour le moment.</p>
                        </div>
                    )}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
