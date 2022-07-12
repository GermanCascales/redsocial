<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReportPost extends Component {
    use AuthorizesRequests;
    
    public Post $post;

    public function render() {
        return view('livewire.report-post');
    }
    
    public function reportPost() {
        $this->authorize('report', $this->post);

        $this->post->reports()->firstOrNew(['user_id' => Auth::id()])->touch(); // si ya está reportado actualiza el campo updated_at

        $this->emit('postReported');
        $this->emit('alertOkVisible', 'El post fue marcado como inapropiado. Gracias por tu colaboración.');
    }
}
