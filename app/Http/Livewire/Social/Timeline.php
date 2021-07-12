<?php

namespace App\Http\Livewire\Social;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Timeline extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title;
    public $body;
    public $images = [];

    public function render()
    {
        $friends = auth()->user()->follows()->pluck('id');

        $posts = Post::whereIn('user_id', $friends)
            ->orWhere('user_id', auth()->user()->id)
            ->with(['image'])
            ->withCount('seens')
            ->latest()
            ->paginate(10);

        return view('livewire.social.timeline', ['posts' => $posts]);
    }

    public function create()
    {
        $data = $this->validate([
            'body' => 'required|max:1000',
            'title' => 'required|max:200',
            'images.*' => 'required|image|max:5000'
        ]);

        $post = Post::create($data);

        if (isset($this->images)) {
            foreach ($this->images as $key => $value) {
                $image = $value->store('/', 'image');
                $post->image()->create([
                    'image' =>  $image,
                    'user_id' => auth()->user()->id
                ]);
            }
        }
        $this->images = [];
        $this->body = '';
        $this->title = '';
        session()->flash('success', 'Post Added Successfully');
    }
}
