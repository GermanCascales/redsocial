<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Report;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReportComment extends Component {
    use AuthorizesRequests;
    
    public Comment $comment;

    protected $listeners = ['setCommentToReport'];

    public function setCommentToReport($commentId) {
        $this->comment = Comment::findOrFail($commentId);

        $this->emit('reportCommentModal');
    }

    public function reportComment() {
        $this->authorize('report', $this->comment);

        $this->comment->reports()->firstOrNew(['user_id' => Auth::id()])->touch(); // si ya está reportado actualiza el campo updated_at
        $this->comment->save();

        $this->emit('commentReported');
        $this->emit('alertOkVisible', 'El comentario fue marcado como inapropiado. Gracias por tu colaboración.');
    }

    public function render() {
        return view('livewire.report-comment');
    }
}
