<?php

namespace App\Http\Controllers\web\Learn;

use App\Http\Requests\VideoRequest;
use App\Models\Lesson;
use App\Models\Video;
use App\Repositories\VideoRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class VideoWebController
{
    private $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VideoRequest $request
     * @param Lesson $lesson
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(VideoRequest $request, Lesson $lesson): RedirectResponse
    {
        $request['lesson_id'] = $lesson->id;

        return redirect()->route('video.show', $this->videoRepository->store($request));
    }

    public function show(Video $video)
    {
        return view('video.show', ['video' => $this->videoRepository->show($video)]);
    }
}
