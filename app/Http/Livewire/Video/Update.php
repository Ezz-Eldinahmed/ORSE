<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $video;
    public $name_edit;
    public $description_edit;
    public $path_edit;

    public function render()
    {
        return view('livewire.video.update');
    }

    public function mount(Video $video)
    {
        $this->description_edit = $video->description;
        $this->name_edit = $video->name;
        $this->video = $video;
    }

    public function delete()
    {
        $this->video->delete();
        Storage::delete("\video\\" . $this->video->path);
        redirect()->route('lesson.show', $this->video->lesson);
    }

    public function edit()
    {
        $data = $this->validate([
            'name_edit' => 'required|max:100',
            'description_edit' => 'required|max:300',
            'path_edit' => 'nullable'
        ]);

        $this->video->update([
            'name' => $data['name_edit'],
            'description' => $data['description_edit']
        ]);

        if (isset($this->path_edit)) {
            Storage::delete($this->video->path);
            $path = $this->path_edit->store('/', 'videos');
            $this->video->path = $path;
            $this->video->save();
        }
        session()->flash('message', 'Video Updated Successfully');
    }
}
