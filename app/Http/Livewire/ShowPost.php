<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowPost extends Component {

    public $post, $likedPost, $likes;

    public function mount($post) {
        $this->likedPost = $post->user_liked(auth()->user());
        $this->likes = $post->likes()->count();
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
        return view('livewire.show-post');
    }
}
