<?php

namespace App\Http\Livewire\Social;

use App\Models\Comment;
use App\Models\Post as PostModel;
use App\Notifications\CommentPost;
use Illuminate\Support\Facades\Notification;
use App\Models\Image;
use App\Notifications\LikePost;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Post extends Timeline
{
    use WithFileUploads;

    public $post;
    public $comment;
    public $title;
    public $body;
    public $images = [];
    public $images_input = [];

    public function render()
    {
        return view('livewire.social.post', ['post' => $this->post->refresh()]);
    }

    public function mount(PostModel $post)
    {
        $this->post = $post;
        $this->images = $post->image;
        $this->title = $post->title;
        $this->body = $post->body;
    }

    public function comment()
    {
        $data = $this->validate([
            'comment' => 'required|max:50'
        ]);

        $comment = $this->post->comment()->create([
            'comment' =>  $data['comment'],
            'user_id' => auth()->user()->id
        ]);

        Notification::send(
            $this->post->user,
            new CommentPost(
                $comment,
                auth()->user(),
                $this->post
            )
        );

        $this->comment = '';
        session()->flash('success', 'Comment Created Successfully');
    }

    public function edit()
    {
        $data = $this->validate([
            'body' => 'required|max:1000',
            'title' => 'required|max:200',
            'images_input.*' => 'required|image|max:5000'
        ]);

        if (isset($this->images_input)) {
            foreach ($this->images_input as $key => $value) {
                $images_input = $value->store('/', 'image');
                $this->post->image()->create([
                    'image' =>  $images_input,
                    'user_id' => auth()->user()->id
                ]);
            }
        }

        $this->images_input = [];
        $this->images = [];
        $this->post->update([
            'body' => $data['body'],
            'title' => $data['title']
        ]);

        session()->flash('success', 'Post Updated Successfully');
    }

    public function delete()
    {
        foreach ($this->post->image as $key => $image) {
            Storage::delete("\image\\" . $image->image);
            $image->delete();
        }
        $this->post->delete();
        session()->flash('success', 'Post Deleted Successfully');
        redirect()->route('timeline');
    }

    public function deleteImage(Image $image)
    {
        Storage::delete("\image\\" . $image->image);
        $image->delete();
        session()->flash('success', 'Image Deleted Successfully');
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        session()->flash('message', 'Comment Deleted Successfully');
    }

    public function like()
    {
        if ($this->post->likes()->where('user_id', auth()->user()->id)->first() != null) {
            if ($this->post->likes()->where('user_id', auth()->user()->id)->first()->like == 1) {
                $this->post->likes()->delete();
            }
        } else if ($this->post->likes()->where('user_id', auth()->user()->id)->first() == null) {
            $this->post->likes()->create([
                'like' =>  1,
                'user_id' => auth()->user()->id,
            ]);
            Notification::send($this->post->user, new LikePost($this->post, auth()->user()));
        }
    }
}
