<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DeletePost extends Component {
    use AuthorizesRequests;
    
    public Post $post;

    public function render() {
        return view('livewire.delete-post');
    }
    
    public function deletePost() {
        $this->authorize('delete', $this->post);

        Post::destroy($this->post->id);

        session()->flash('ok_alert', 'El post fue eliminado correctamente.');

        return redirect()->route('posts.index');
    }
}
