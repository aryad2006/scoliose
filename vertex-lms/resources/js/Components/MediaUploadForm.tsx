import { useState } from 'react';
import { router } from '@inertiajs/react';
import { PhotoIcon, DocumentIcon } from '@heroicons/react/24/outline';

interface MediaUploadFormProps {
    lessonId: number;
    onUpload?: () => void;
}

const collectionOptions = [
    { value: 'images', label: 'Image', icon: PhotoIcon },
    { value: 'videos', label: 'Vidéo', icon: DocumentIcon },
    { value: 'documents', label: 'Document', icon: DocumentIcon },
];

export default function MediaUploadForm({ lessonId, onUpload }: MediaUploadFormProps) {
    const [loading, setLoading] = useState(false);
    const [collection, setCollection] = useState<'images' | 'videos' | 'documents'>('images');
    const [dragActive, setDragActive] = useState(false);
    const [errors, setErrors] = useState<string[]>([]);

    const handleDrag = (e: React.DragEvent) => {
        e.preventDefault();
        e.stopPropagation();
        if (e.type === 'dragenter' || e.type === 'dragover') {
            setDragActive(true);
        } else if (e.type === 'dragleave') {
            setDragActive(false);
        }
    };

    const handleDrop = (e: React.DragEvent) => {
        e.preventDefault();
        e.stopPropagation();
        setDragActive(false);

        const files = e.dataTransfer.files;
        if (files && files[0]) {
            handleUpload(files[0]);
        }
    };

    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const files = e.currentTarget.files;
        if (files && files[0]) {
            handleUpload(files[0]);
        }
    };

    const handleUpload = (file: File) => {
        const formData = new FormData();
        formData.append('file', file);
        formData.append('collection', collection);

        setLoading(true);
        setErrors([]);

        router.post(`/api/lessons/${lessonId}/media`, formData, {
            onSuccess: () => {
                onUpload?.();
            },
            onError: (errors) => {
                if (typeof errors === 'object') {
                    setErrors(Object.values(errors).flat() as string[]);
                } else {
                    setErrors(['Erreur lors de l\'upload']);
                }
            },
            onFinish: () => {
                setLoading(false);
            },
        });
    };

    return (
        <div className="border border-gray-200 rounded-lg p-6">
            <h3 className="text-lg font-semibold text-gray-900 mb-4">Ajouter un média</h3>

            {/* Collection Selection */}
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700 mb-2">
                    Type de média
                </label>
                <select
                    value={collection}
                    onChange={(e) => setCollection(e.target.value as 'images' | 'videos' | 'documents')}
                    disabled={loading}
                    className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    {collectionOptions.map(opt => (
                        <option key={opt.value} value={opt.value}>
                            {opt.label}
                        </option>
                    ))}
                </select>
            </div>

            {/* File Upload Area */}
            <div
                onDragEnter={handleDrag}
                onDragLeave={handleDrag}
                onDragOver={handleDrag}
                onDrop={handleDrop}
                className={`border-2 border-dashed rounded-lg p-8 text-center transition ${
                    dragActive
                        ? 'border-blue-500 bg-blue-50'
                        : 'border-gray-300 hover:border-gray-400'
                }`}
            >
                <input
                    type="file"
                    id="media-upload"
                    onChange={handleChange}
                    disabled={loading}
                    className="hidden"
                    accept={
                        collection === 'images'
                            ? 'image/*'
                            : collection === 'videos'
                            ? 'video/*'
                            : '.pdf'
                    }
                />

                <label
                    htmlFor="media-upload"
                    className="cursor-pointer"
                >
                    <div className="text-gray-600">
                        <p className="text-sm font-medium">
                            {loading
                                ? 'Upload en cours...'
                                : 'Glissez-déposez un fichier ou cliquez pour sélectionner'}
                        </p>
                        <p className="text-xs text-gray-500 mt-1">
                            {collection === 'images'
                                ? 'JPG, PNG, GIF, WebP (max 100MB)'
                                : collection === 'videos'
                                ? 'MP4, WebM (max 100MB)'
                                : 'PDF (max 100MB)'}
                        </p>
                    </div>
                </label>
            </div>

            {/* Errors */}
            {errors.length > 0 && (
                <div className="mt-4 bg-red-50 border border-red-200 rounded-lg p-4">
                    <ul className="list-disc list-inside text-sm text-red-700">
                        {errors.map((error, idx) => (
                            <li key={idx}>{error}</li>
                        ))}
                    </ul>
                </div>
            )}
        </div>
    );
}
