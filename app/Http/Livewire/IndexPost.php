<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IndexPost extends Component {

    public $post, $likedPost, $likes;

    public function mount($post) {
        $this->likedPost = $post->liked_by_user;
    }

    public function render() {
        return view('livewire.index-post');
    }
}
