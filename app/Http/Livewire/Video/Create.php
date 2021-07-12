<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;
use App\Models\Lesson;
use App\Models\Video;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $video;
    public $lesson;

    public function render()
    {
        return view('livewire.video.create');
    }

    public function create(Lesson $lesson)
    {
        $this->validate([
            'video' => 'required|max:10000|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv'
        ]);

        if (isset($this->video)) {
            $video = $this->video->store('/', 'videos');
            $object = Video::create(
                [
                    'name' => $this->name,
                    'description' => $this->description,
                    'path' => $video,
                    'lesson_id' => $lesson->id,
                ]
            );
        }
        session()->flash('message', 'Video Added Successfully');
        redirect()->route('video.show', $object);
    }

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }
}
