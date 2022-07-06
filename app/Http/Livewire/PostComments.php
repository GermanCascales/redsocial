<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostComments extends Component {
    public Post $post;

    protected $listeners = ['commentCreated' => '$refresh'];

    public function render() {
        return view('livewire.post-comments', ['comments' => $this->post->comments->load('user')->sortByDesc('updated_at')]);
    }
}
