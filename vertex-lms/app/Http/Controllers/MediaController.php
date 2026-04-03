<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Http\Requests\StoreMediaRequest;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class MediaController extends Controller
{
    /**
     * Upload media file and attach to lesson
     */
    public function store(StoreMediaRequest $request, Lesson $lesson)
    {
        $validated = $request->validated();

        try {
            $media = $lesson
                ->addMediaFromRequest('file')
                ->toMediaCollection($validated['collection']);

            return response()->json([
                'id' => $media->id,
                'name' => $media->name,
                'url' => $media->getUrl(),
                'collection' => $validated['collection'],
            ], 201);
        } catch (FileDoesNotExist|FileIsTooBig $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * Delete media file
     */
    public function destroy(Lesson $lesson, $mediaId)
    {
        $media = $lesson->media()->findOrFail($mediaId);
        $media->delete();

        return response()->noContent();
    }

    /**
     * Get lesson media
     */
    public function index(Lesson $lesson)
    {
        return response()->json(
            $lesson->media->map(fn($m) => [
                'id' => $m->id,
                'name' => $m->name,
                'url' => $m->getUrl(),
                'collection' => $m->collection_name,
                'size' => $m->size,
                'created_at' => $m->created_at,
            ])
        );
    }
}
