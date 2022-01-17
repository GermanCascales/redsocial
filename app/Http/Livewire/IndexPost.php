<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IndexPost extends Component {

    public $post, $likedPost, $likes;

    public function mount($post) {
        $this->likedPost = $post->liked_by_user;
    }

    public function like_button() {
        if (!auth()->check()) {
            return redirect(route('login'));
        }

        if ($this->likedPost) {
            $this->post->delete_like(auth()->user());
            $this->likedPost = false;
            $this->likes--;
        } else {
            $this->post->create_like(auth()->user());
            $this->likedPost = true;
            $this->likes++;
        }
    }

    public function render() {
        return view('livewire.index-post');
    }
}
