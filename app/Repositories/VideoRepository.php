<?php

namespace App\Repositories;

use App\Http\Requests\VideoRequest;
use App\Http\Resources\ApiResource;
use App\Models\Lesson;
use App\Models\Video;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoRepository
{
    /**
     * @throws \Throwable
     */
    public function store(VideoRequest $request)
    {
        Lesson::findOrFail($request->lesson_id);

        DB::beginTransaction();
        try {
            $path = $request->file('path')->store('videos');

            DB::commit();
            return Video::create([
                'name' =>  $request->name,
                'description' => $request->description,
                'lesson_id' => $request->lesson_id,
                'path' => $path
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function update(VideoRequest $request, Video $video)
    {
        DB::beginTransaction();
        try {
            if (isset($video->path)) {
                Storage::delete($video->path);
                $path = $request->file('path')->store('videos');
                $video->path = $path;
                $video->save();
            }

            DB::commit();

            $video->update([
                'name' =>  $request->name,
                'description' => $request->description,
                'Lesson_id' => $video->Lesson->id
            ]);
            return new ApiResource($video);
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function destroy(Video $video)
    {
        Storage::delete($video->path);
        $video->delete();
        return new ApiResource($video);
    }

    public function show(Video $video)
    {
        if (Auth::check()) {
            $video->seens()->firstOrCreate([
                'user_id' => auth()->user()->id,
            ]);
        }
        return $video;
    }
}
