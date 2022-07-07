<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DeleteComment extends Component {
    use AuthorizesRequests;
    
    public Comment $comment;

    protected $listeners = ['setCommentToDelete'];

    public function setCommentToDelete($commentId) {
        $this->comment = Comment::findOrFail($commentId);

        $this->emit('deleteCommentModal');
    }

    public function deleteComment() {
        $this->authorize('delete', $this->comment);

        $this->comment->delete();

        $this->emit('commentDeleted');
        $this->emit('alertOkVisible', 'El comentario fue eliminado correctamente.');
    }

    public function render() {
        return view('livewire.delete-comment');
    }
}
