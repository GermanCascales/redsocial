<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class PostComment extends Component {
    public Comment $comment;

    protected $listeners = ['commentUpdated'];

    public function commentUpdated() {
        $this->comment->refresh();
    }

    public function render() {
        return view('livewire.post-comment', ['comment' => $this->comment]);
    }
}
