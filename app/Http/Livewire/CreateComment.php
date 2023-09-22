<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use App\Notifications\CommentAdded;
use Illuminate\Http\Response;
use Livewire\Component;

class CreateComment extends Component
{
    public $idea;
    public $comment;
    protected $rules = [
        'comment' => 'required|min:4',
    ];

    public function messages()
    {
        return [
            'comment.min' => 'Komentarz musi mieć przynajmniej :min znaki.',
        ];
    }

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function createComment()
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $newComment = Comment::create([
            'user_id' => auth()->id(),
            'idea_id' => $this->idea->id,
            'status_id' => 1,
            'body' => $this->comment,
        ]);

        $this->reset('comment');

        $this->idea->user->notify(new CommentAdded($newComment));

        $this->emit('commentWasCreated', 'Komentarz został dodany!');
    }

    public function render()
    {
        return view('livewire.create-comment');
    }
}
