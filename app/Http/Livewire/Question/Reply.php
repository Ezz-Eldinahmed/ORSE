<?php

namespace App\Http\Livewire\Question;

use Livewire\Component;
use App\Models\Question;
use App\Models\Reply as ModelsReply;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReplyAdded;
use App\Notifications\ReplySetToBestReply;
use App\Repositories\ReplyRepository;
use Livewire\WithFileUploads;

class Reply extends Component
{
    use WithFileUploads;

    public $answer_edit;
    public $answer;
    public $replys;
    public $question;
    public $reply;
    public $images = [];

    public function mount(Question $question)
    {
        $this->question = $question;
    }

    public function render()
    {
        $this->replys = $this->question->refresh()->replys;

        return view(
            'livewire.question.reply',
            [
                'question' => $this->question,
                'replys' => $this->replys
            ]
        );
    }

    public function create()
    {
        $data = $this->validate([
            'answer' => 'required|max:1000',
            'images.*' => 'required|image|max:5000'
        ]);

        $reply = ModelsReply::create([
            'answer' => $data['answer'],
            'question_id' => $this->question->id
        ]);


        if (isset($this->images)) {
            foreach ($this->images as $key => $value) {
                $image = $value->store('/', 'image');
                $reply->image()->create([
                    'image' =>  $image,
                    'user_id' => auth()->user()->id
                ]);
            }
        }
        Notification::send($this->question->user, new ReplyAdded($this->question, auth()->user()));
        $this->images = [];
        $this->answer = '';

        session()->flash('message', 'Reply Created Successfully');
    }

    public function setBestReply(ModelsReply $reply)
    {
        return ReplyRepository::bestReply($reply);
    }

    public function delete(ModelsReply $reply)
    {
        $reply->delete();
        session()->flash('message', 'Reply Deleted Successfully');
    }

    public function pressButton(ModelsReply $reply)
    {
        $this->answer_edit = $reply->answer;
    }

    public function editReply(ModelsReply $reply)
    {
        $data = $this->validate([
            'answer_edit' => 'required|max:1000',
        ]);

        $reply->update($data);
        session()->flash('updatereply', 'Reply Updated Successfully');
    }
}
