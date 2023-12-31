<?php

namespace App\Http\Livewire;

use App\Mail\IdeaStatusUpdatedMail;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SetStatus extends Component
{
    public $idea;
    public $status;
    public $comment;
    public $notifyAllVoters;

    public function mount(Idea $idea)
    {
        $this->idea=$idea;
        $this->status = $this->idea->status_id;
    }

    public function setStatus()
    {
        if (! auth()->check() ) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if($this->idea->status_id == $this->status){
            $this->emit('statusWasUpdatedError', 'Status jest taki sam!');
            return;
        }

        $this->idea->status_id = $this->status;
        $this->idea->save();

        if ($this->notifyAllVoters) {
            $this->notifyAllVoters();
        }

        Comment::create([
            'user_id' => auth()->id(),
            'idea_id' => $this->idea->id,
            'status_id' => $this->status,
            'body' => $this->comment ? $this->comment : 'Nie dodano komentarza.',
            'is_status_update' => true,
        ]);

        $this->reset('comment');

        $this->emit('statusWasUpdated', 'Status został zaktualizowany!');
    }

    public function notifyAllVoters()
    {
        $this->idea->votes()
            ->select('name', 'email')
            ->chunk(100, function ($voters) {
                foreach ($voters as $user) {
                    Mail::to($user)
                        ->queue(new IdeaStatusUpdatedMail($this->idea));
                }
            });
    }

    public function render()
    {
        return view('livewire.set-status');
    }
}
