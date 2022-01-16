<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowPost extends Component {

    public $post, $likedPost, $likes;

    public function mount($post) {
        $this->likedPost = $post->user_liked(auth()->user());
        $this->likes = $post->likes()->count();
    }

    public function render() {
        return view('livewire.show-post');
    }
}
