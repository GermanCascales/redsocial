<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditComment extends Component {
    use AuthorizesRequests;
    
    public Comment $comment;
    public $message;

    protected $listeners = ['setCommentToEdit'];
    protected $rules = ['message' => 'required|min:3'];

    public function setCommentToEdit($commentId) {
        $this->comment = Comment::findOrFail($commentId);
        $this->message = $this->comment->message;

        $this->resetValidation(); // quita los errores de validación que pudieran haber quedado
        $this->emit('editCommentModal');
    }

    public function updateComment() {
        $this->authorize('update', $this->comment);

        $this->validate();

        $this->comment->message = $this->message;
        $this->comment->save();

        $this->emit('commentUpdated');
        $this->emit('alertOkVisible', 'El comentario fue editado correctamente.');
    }

    public function render() {
        return view('livewire.edit-comment');
    }
}
